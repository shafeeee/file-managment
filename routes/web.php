<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth'])->name('dashboard');

Route::middleware(['auth', 'role:1'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::delete('/admin/users/{id}', [AdminController::class, 'deleteUser'])->name('admin.deleteUser');
    Route::get('/admin/users/add', [AdminController::class, 'showAddUserForm'])->name('admin.showAddUserForm');
    Route::post('/admin/users/add', [AdminController::class, 'addUser'])->name('admin.addUser');
    Route::get('/admin/users/{userId}/upload', [AdminController::class, 'showUploadForm'])->name('admin.showUploadForm');
    Route::post('/admin/users/{userId}/upload', [AdminController::class, 'uploadFile'])->name('admin.uploadFile');
});

Route::middleware(['auth', 'role:0'])->group(function () {
    Route::get('/user/dashboard', [UserController::class, 'dashboard'])->name('dashboard');
    Route::get('/user/upload', [UserController::class, 'showUploadForm'])->name('user.showUploadForm');
    Route::post('/user/upload', [UserController::class, 'uploadFile'])->name('user.uploadFile');
});

require __DIR__.'/auth.php';
