<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Storage;


class UserController extends Controller
{
    public function dashboard()
    {
        $user = auth()->user();
        $files = $user->files;

        return view('dashboard', compact('user', 'files'));
    }

    public function showUploadForm()
    {
        return view('upload_file');
    }

    public function uploadFile(Request $request)
    {
        // Validation rules, customize as needed
        $request->validate([
            'file' => 'required|file|mimes:jpeg,png,pdf|max:2048', // Adjust the allowed file types and maximum size
        ]);

        $user = auth()->user();
        $userFolderPath = 'uploads/' . $user->id;

        $file = $request->file('file');

        // Store the file in the user's folder
        $path = $file->storeAs($userFolderPath, $file->getClientOriginalName(), 'public');

        // Save the file name to the database
        $user->files()->create([
            'file_name' => $file->getClientOriginalName(),
            'file_path' => $path,
        ]);

        return redirect()->route('dashboard')->with('success', 'File uploaded successfully');
    }
}

