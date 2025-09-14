<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin;
use App\Models\Room;
use App\Models\Booking;

class AdminController extends Controller
{
    // Show login form
    public function showLoginForm()
    {
        return view('admin.login'); // resources/views/admin/login.blade.php
    }

    // Handle login
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::guard('admin')->attempt($credentials)) {
            return redirect()->route('admin.dashboard');
        }

        return back()->withErrors(['email' => 'Invalid credentials.']);
    }

    // Admin dashboard
    public function dashboard()
    {
        return view('admin.dashboard'); // resources/views/admin/dashboard.blade.php
    }

    // Logout
    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login.form');
    }

    // View all rooms
    public function rooms()
    {
        $rooms = Room::all();
        return view('admin.rooms', compact('rooms')); // resources/views/admin/rooms.blade.php
    }

    // Update room price
    public function updateRoomPrice(Request $request, Room $room)
    {
        $request->validate([
            'price' => 'required|numeric|min:0',
        ]);

        $room->price = $request->price;
        $room->save();

        return back()->with('success', 'Room price updated successfully.');
    }
    // View all bookings
    public function bookings()
    {
        $bookings = Booking::with('room', 'user')->get();
        return view('admin.bookings', compact('bookings'));
    }

    // Delete a booking
    public function deleteBooking(Booking $booking)
    {
        $booking->delete();
        return back()->with('success', 'Booking deleted successfully.');
    }
}
