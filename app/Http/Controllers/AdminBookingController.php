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
            'room_id' => 'required|exists:rooms,id',
            'name' => 'required|string|max:255',
            'mobile_number' => 'required|string|max:20',
            'booking_date' => 'required|date',
        ]);

        Booking::create([
            'room_id' => $request->room_id,
            'name' => $request->name,
            'mobile_number' => $request->mobile_number,
            'booking_date' => $request->booking_date,
            'status' => 'active',
        ]);

        return redirect()->route('admin.bookings')->with('success', 'Booking created successfully!');
    }
}
