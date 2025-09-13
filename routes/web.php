<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AdminController;

// ----------------------
// Dashboard
// ----------------------
Route::get('/', [DashboardController::class, 'index'])
    ->middleware('auth')
    ->name('dashboard');

// ----------------------
// Registration (User)
// ----------------------
Route::get('/register', function () {
    return view('index'); // registration form
})->name('register');

Route::post('/register', [UserController::class, 'store'])
    ->name('register.user');

// ----------------------
// User Login
// ----------------------
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.user');

// ----------------------
// User Logout
// ----------------------
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// ----------------------
// Rooms
// ----------------------
Route::get('/rooms/{room}', [RoomController::class, 'show'])->name('rooms.show');
Route::post('/rooms/{room}/book', [RoomController::class, 'book'])->name('rooms.book');

// ----------------------
// Bookings (User - only for authenticated users)
// ----------------------
Route::middleware('auth')->group(function () {
    Route::get('/my-bookings', [BookingController::class, 'myBookings'])->name('my.bookings');
    Route::delete('/bookings/{id}/cancel', [BookingController::class, 'cancel'])->name('bookings.cancel');
});

// ----------------------
// Admin Login (accessible without authentication)
// ----------------------
Route::get('/admin/login', [AdminController::class, 'showLoginForm'])->name('admin.login.form');
Route::post('/admin/login', [AdminController::class, 'login'])->name('admin.login');

// Optional: Admin Dashboard (only for authenticated admins)
// Route::middleware('auth:admin')->group(function () {
//     Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
// });