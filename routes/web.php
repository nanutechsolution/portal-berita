<?php

use App\Http\Controllers\ArchiveController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Livewire\Admin\Categories\ManageCategories;
use App\Livewire\Admin\Posts\ManagePosts;
use Illuminate\Support\Facades\Route;

Route::get('/', [\App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/admin/categories', ManageCategories::class)->name('admin.categories');

    Route::get('/admin/posts', ManagePosts::class)->name('admin.posts');
});

require __DIR__ . '/auth.php';


Route::get('/kategori/{category:slug}', [ArchiveController::class, 'showByCategory'])->name('archive.category');
Route::get('/tag/{tag:slug}', [ArchiveController::class, 'showByTag'])->name('archive.tag');


Route::get('/{post:slug}', [HomeController::class, 'show'])->name('post.show');
