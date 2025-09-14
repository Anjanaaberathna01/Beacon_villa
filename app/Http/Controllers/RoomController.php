<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Room;
use App\Models\Booking;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class RoomController extends Controller
{
    // Display all rooms on dashboard
    public function index()
    {
        $today = Carbon::today()->toDateString();

        // Just fetch rooms (no prices/images here)
        $rooms = Room::with('bookings')
            ->whereBetween('room_number', [1, 5])
            ->orderBy('room_number')
            ->get();

        return view('dashboard', compact('rooms', 'today'));
    }

    // Show single room
    public function show($id)
    {
        $room = Room::with('bookings')->find($id);

        if (!$room) {
            return redirect()->route('dashboard')->with('error', 'Room not found.');
        }

        return view('rooms.show', compact('room'));
    }

    // Book a room
    public function book(Request $request, $roomId)
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'You must login first.');
        }

        $room = Room::findOrFail($roomId);
        $bookingDate = $request->booking_date ?? Carbon::today()->toDateString();

        // Check if already booked
        $existingBooking = Booking::where('room_id', $roomId)
            ->where('booking_date', $bookingDate)
            ->where('status', 'active')
            ->first();

        if ($existingBooking) {
            return redirect()->back()->with('error', 'This room is already booked for ' . $bookingDate);
        }

           Booking::create([
    'room_id' => $roomId,
    'user_id' => Auth::id(),
    'name' => Auth::user()->name,
    'email' => Auth::user()->email,
    'mobile_number' => Auth::user()->mobile_number ?? $request->mobile_number,
    'booking_date' => $bookingDate,
    'status' => 'active',
]);



        return redirect()->back()->with('success', 'Room booked successfully for ' . $bookingDate);
    }
}
