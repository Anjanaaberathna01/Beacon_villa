<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class BookingController extends Controller
{
    public function myBookings()
    {
        $bookings = Booking::with('room')
            ->where('user_id', Auth::id())
            ->orderBy('booking_date', 'asc')
            ->get();

        // Auto-update past bookings
        foreach ($bookings as $b) {
            if (Carbon::parse($b->booking_date)->isPast() && $b->status === 'active') {
                $b->update(['status' => 'completed']);
            }
        }

        return view('my-bookings', compact('bookings'));
    }

    public function cancel($id)
    {
        $booking = Booking::findOrFail($id);

        if ($booking->user_id !== Auth::id()) {
            return back()->with('error', 'You cannot cancel this booking.');
        }

        if ($booking->status === 'completed') {
            return back()->with('error', 'You cannot cancel a completed booking.');
        }

        $booking->delete();

        return back()->with('success', 'Booking cancelled successfully!');
    }
}
