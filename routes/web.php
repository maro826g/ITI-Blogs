<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\MailController;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/posts', [PostController::class, 'index'])->name("posts.index");

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware(['auth'])->group(function () {
    //Route::get('/posts',[PostController::class,'index'])->name("posts.index");
    Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create');
    Route::post('/posts', [PostController::class, 'store'])->name('posts.store');
    Route::get('/posts/{id}', [PostController::class, 'show'])->name("posts.show");
    Route::get('/posts/{id}/edit', [PostController::class, 'edit'])->name("posts.edit");
    Route::put('/posts/{id}', [PostController::class, 'update'])->name("posts.update");
    Route::delete('/posts/{id}', [PostController::class, 'destroy'])->name("posts.destroy");
});

// Route for sending a test email
Route::get('/send-test-mail', [MailController::class, 'sendTestEmail']) ->name("emails.test");
