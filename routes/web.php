<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\SubscriptionController;
use Illuminate\Support\Facades\Route;

// Halaman publik (bisa dijelajahi tanpa login)
Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('/kursus', [PageController::class, 'courses'])->name('courses');
Route::get('/kursus/{slug}', [PageController::class, 'lesson'])->name('lesson');
Route::get('/tentang', [PageController::class, 'about'])->name('about');
Route::get('/berlangganan', [PageController::class, 'subscription'])->name('subscription');

// Hanya tamu
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->middleware('throttle:10,1');
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->middleware('throttle:10,1');
});

// Hanya member (Free dan Pro)
Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('/kursus/{slug}/latihan', [PageController::class, 'exercise'])->name('exercise');

    Route::get('/profile', [AccountController::class, 'show'])->name('profile');
    Route::put('/profile', [AccountController::class, 'update'])->name('profile.update');
    Route::put('/profile/password', [AccountController::class, 'password'])->name('profile.password');
    Route::delete('/profile', [AccountController::class, 'destroy'])->name('profile.destroy');

    Route::post('/berlangganan/upgrade', [SubscriptionController::class, 'upgrade'])->name('subscription.upgrade');
    Route::post('/berlangganan/downgrade', [SubscriptionController::class, 'downgrade'])->name('subscription.downgrade');

    Route::get('/chat', [ChatController::class, 'index'])->name('chat');
    Route::post('/chat/messages', [ChatController::class, 'send'])->middleware('throttle:20,1')->name('chat.send');
    Route::delete('/chat/messages', [ChatController::class, 'clear'])->name('chat.clear');
});
