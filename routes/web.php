<?php

use App\Http\Controllers\Guest\HomeController as GuestHomeController;
use App\Http\Controllers\Admin\HomeController as AdminHomeController;
use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [GuestHomeController::class, 'index']);


// Protected routes
Route::middleware(['auth', 'verified'])->name('admin.')->prefix('/admin')->group(function () {
    // Dashboard routes
    Route::get('/', [AdminHomeController::class, 'index'])->name('home');
    // Toggle routes
    Route::patch('/projects/{project}/toggle', [ProjectController::class, 'toggle'])->name('projects.toggle');
    //TRASH
    Route::get('/projects/trash', [ProjectController::class, 'trash'])->name('projects.trash.index');
    Route::patch('/projects/{project}/restore', [ProjectController::class, 'restore'])->name('projects.trash.restore');
    Route::delete('/projects/{project}/drop', [ProjectController::class, 'drop'])->name('projects.trash.drop');
    Route::delete('/projects/drop', [ProjectController::class, 'dropAll'])->name('projects.trash.dropAll');
    // Project routes
    Route::resource('projects', ProjectController::class);
});

// Profile routes
Route::middleware('auth')->name('profile.')->prefix('/profile')->group(function () {
    Route::get('/', [ProfileController::class, 'edit'])->name('edit');
    Route::patch('/', [ProfileController::class, 'update'])->name('update');
    Route::delete('/', [ProfileController::class, 'destroy'])->name('destroy');
});

require __DIR__ . '/auth.php';
