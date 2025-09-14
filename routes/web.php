<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AdminController;
use App\Http\Middleware\AdminMiddleware;

// ----------------------
// Dashboard (User)
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
    Route::get('/my-bookings', [BookingController::class, 'index'])->name('my.bookings');
    Route::post('/bookings', [BookingController::class, 'store'])->name('bookings.store');
    Route::delete('/bookings/{id}/cancel', [BookingController::class, 'cancel'])->name('bookings.cancel');
});

// ----------------------
// Admin login routes
// ----------------------
Route::get('/admin/login', [AdminController::class, 'showLoginForm'])->name('admin.login.form');
Route::post('/admin/login', [AdminController::class, 'login'])->name('admin.login');

// ----------------------
// Admin protected routes
// ----------------------
Route::middleware([AdminMiddleware::class])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::post('/admin/logout', [AdminController::class, 'logout'])->name('admin.logout');

    // Admin rooms management
    Route::get('/admin/rooms', [AdminController::class, 'rooms'])->name('admin.rooms');

    // <-- THIS ROUTE MUST EXIST -->
    Route::post('/admin/rooms/{room}/update-price', [AdminController::class, 'updateRoomPrice'])->name('admin.rooms.update-price');

    // Admin bookings
    Route::get('/admin/bookings', [AdminController::class, 'bookings'])->name('admin.bookings');
    Route::delete('/admin/bookings/{booking}/delete', [AdminController::class, 'deleteBooking'])->name('admin.bookings.delete');
});