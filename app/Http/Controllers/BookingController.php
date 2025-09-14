<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    // Show all bookings for the logged-in user
    public function index()
    {
        $user = Auth::user(); // get current logged-in user
        $bookings = Booking::where('user_id', $user->id)->with('room')->get();

        return view('my-bookings', compact('bookings'));
    }

    // Optional: cancel a booking
    public function cancel($id)
    {
        $booking = Booking::findOrFail($id);
        if ($booking->user_id !== Auth::id()) {
            return redirect()->back()->with('error', 'Unauthorized');
        }
        $booking->delete();
        return redirect()->back()->with('success', 'Booking canceled successfully.');
    }
}