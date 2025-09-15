<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Room;
use App\Models\Booking;

class AdminBookingController extends Controller
{
    // Show booking creation form
    public function create()
    {
        $rooms = Room::all(); // get all rooms
        return view('admin.bookings-create', compact('rooms'));
    }

    // Handle booking creation
    public function store(Request $request)
    {
        $request->validate([
            'room_number' => 'required|exists:rooms,room_number',
            'name' => 'required|string|max:255',
            'mobile_number' => 'required|string|max:15',
            'booking_date' => 'required|date',
        ]);

        // Find the room by its number
        $room = \App\Models\Room::where('room_number', $request->room_number)->first();

        Booking::create([
            'room_id' => $room->id, //store the actual ID
            'name' => $request->name,
            'mobile_number' => $request->mobile_number,
            'booking_date' => $request->booking_date,
            'status' => 'active',
            'user_id' => null,
        ]);

        return redirect()->route('admin.bookings')
            ->with('success', 'Booking created successfully.');
    }

}