<?php
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\DashboardController;

// Dashboard
Route::get('/', [DashboardController::class, 'index'])->middleware('auth')->name('dashboard');

// Registration
Route::get('/register', function () {
    return view('index'); // registration form
})->name('register');
Route::post('/register', [UserController::class, 'store'])->name('register.user');

// Login
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.user');

// Logout
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Rooms
Route::get('/rooms/{room}', [RoomController::class, 'show'])->name('rooms.show'); // optional room details page
Route::post('/rooms/{room}/book', [RoomController::class, 'book'])->name('rooms.book'); // booking action

// Bookings (user)
Route::middleware('auth')->group(function () {
    Route::get('/my-bookings', [BookingController::class, 'myBookings'])->name('my.bookings');
    Route::delete('/bookings/{id}/cancel', [BookingController::class, 'cancel'])->name('bookings.cancel');
});
