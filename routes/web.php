<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PublicPostController;
use Illuminate\Support\Facades\Route;

use function Pest\Laravel\post;

Route::get('/', [PublicPostController::class, 'index'])->name('home');
Route::get('/blogs/{blog}', [PublicPostController::class, 'show'])->name('blogs.single');
Route::get('/archive/{category:slug}', [PublicPostController::class, 'archive'])->name('blogs.archive');

Route::get('/page-not-found', function () {
    return view('404');
})->name('nopage');


Route::middleware(['auth', 'verified', 'role:admin,author'])->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('dashboard/blogs', [PostController::class, 'index'])->name('blogs.index');
    Route::get('dashboard/blogs/create', [PostController::class, 'create'])->name('blogs.create');
    Route::post('dashboard/blogs', [PostController::class, 'store'])->name('blogs.store');
    Route::delete('dashboard/blogs/{id}', [PostController::class, 'destroy'])->name('blogs.destroy');
    Route::get('dashboard/blog/{post}/edit', [PostController::class, 'edit'])->name('blogs.edit');
    Route::put('dashboard/blog/{post}/update', [PostController::class, 'update'])->name('blogs.update');

    Route::get('dashboard/category', [CategoryController::class, 'index'])->name('category.index');
    Route::get('dashboard/category/create', [CategoryController::class, 'create'])->name('category.create');
    Route::post('dashboard/category', [CategoryController::class, 'store'])->name('category.store');
    Route::get('dashboard/category/{category}/edit', [CategoryController::class, 'edit'])->name('category.edit');
    Route::put('dashboard/category/{category}', [CategoryController::class, 'update'])->name('category.update');
    Route::delete('dashboard/category/{id}', [CategoryController::class, 'destroy'])->name('category.destroy');

    Route::post('/posts/{post}/like', [LikeController::class, 'toggleLike'])->name('posts.like');
});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
