<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function dashboard()
    {
        $users = User::where('user_role', '!=', 1)->get();
        return view('admin.dashboard', compact('users'));
    }

    public function deleteUser($id)
    {
        DB::beginTransaction();

        try {
            // Delete files associated with the user
            File::where('user_id', $id)->delete();

            // Now, delete the user
            User::find($id)->delete();

            // Delete associated files and folders, we can use event listner or jobs for async
            $files = File::where('user_id', $id)->get();

            foreach ($files as $file) {
                $filePath = storage_path('app/public/' . $file->file_path);

                // Delete the file
                if (file_exists($filePath)) {
                    unlink($filePath);
                }

                // Delete the folder
                $folderPath = storage_path('app/public/uploads/' . $id);

                if (is_dir($folderPath)) {
                    rmdir($folderPath);
                }
            }

            DB::commit();
            
        } catch (\Exception $e) {
            DB::rollback();
            // Handle the exception
        }

        return redirect()->route("admin.dashboard")->with('success', 'User deleted successfully');
    }

    public function showAddUserForm()
    {
        return view('admin.add_user');
    }

    public function addUser(Request $request)
    {
        // Validation rules, customize as needed
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8',
        ]);

        // Create the user
        User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => bcrypt($validatedData['password']),
            'user_role' => 0, // Assuming 0 for regular user
        ]);

        return redirect()->route("admin.dashboard")->with('success', 'User added successfully');
    }

    public function showUploadForm($userId)
    {
        $user = User::findOrFail($userId);
        return view('admin.upload_file', compact('user'));
    }

    public function uploadFile(Request $request, $userId)
    {
        // Validation rules, customize as needed
        $request->validate([
            'file' => 'required|file|mimes:jpeg,png,pdf|max:2048', // Adjust the allowed file types and maximum size
        ]);

        $user = User::findOrFail($userId);

        $file = $request->file('file');

        // Store the file in the user's folder
        $path = $file->storeAs('uploads/' . $user->id, $file->getClientOriginalName(), 'public');

        // Save the file name to the database
        $user->files()->create([
            'file_name' => $file->getClientOriginalName(),
            'file_path' => 'uploads/' . $user->id . '/' . $file->getClientOriginalName()
        ]);


        return redirect()->route('admin.dashboard')->with('success', 'File uploaded successfully');
    }
}
