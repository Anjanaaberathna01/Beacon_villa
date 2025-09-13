<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Room;

class DashboardController extends Controller
{
    public function index()
    {
        // Delete any rooms outside 1-5 (optional: ensures only 5 rooms exist)
        Room::whereNotBetween('room_number', [1, 5])->delete();

        // Ensure rooms 1 to 5 exist
        for ($i = 1; $i <= 5; $i++) {
            Room::firstOrCreate(
                ['room_number' => $i], // look for existing room with this number
                ['description' => 'Comfortable room with all amenities.', 'price' => 4500] // default data
            );
        }

        // Fetch all 5 rooms
        $rooms = Room::whereBetween('room_number', [1, 5])
                     ->orderBy('room_number')
                     ->get();

        return view('dashboard', compact('rooms'));
    }
}
