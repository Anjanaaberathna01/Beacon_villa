@include('layouts.admin-navbar')

@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="{{ asset('css/admin-booked-room.css') }}">

<div class="admin-container">
    <h1>Create Booking (Admin)</h1>

    <!-- Success message -->
    @if(session('success'))
        <div class="alert-success">{{ session('success') }}</div>
    @endif

    <!-- Error messages -->
    @if ($errors->any())
        <div class="alert-error">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.bookings.store') }}" method="POST" id="bookingForm">
        @csrf

        <div class="form-group">
            <label for="room_id">Select Room:</label>
            <select name="room_id" required>
                <option value="">-- Choose Room --</option>
                @foreach($rooms as $room)
                    <option value="{{ $room->id }}">Room {{ $room->room_number }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="name">Customer Name:</label>
            <input type="text" name="name" required>
        </div>

        <div class="form-group">
            <label for="mobile_number">Mobile Number:</label>
            <input type="text" name="mobile_number" required>
        </div>

        <div class="form-group">
            <label for="booking_date">Booking Date:</label>
            <input type="date" name="booking_date" id="booking_date" required>
        </div>

        <button type="submit" class="btn-submit">Save Booking</button>
    </form>
</div>

<!-- Simple JavaScript validation -->
<script>
    // Prevent selecting past dates
    document.addEventListener("DOMContentLoaded", function () {
        const today = new Date().toISOString().split("T")[0];
        document.getElementById("booking_date").setAttribute("min", today);

        // Form validation before submit
        document.getElementById("bookingForm").addEventListener("submit", function (e) {
            const mobile = document.querySelector("input[name='mobile_number']").value;
            if (!/^[0-9]{10}$/.test(mobile)) {
                e.preventDefault();
                alert("Please enter a valid 10-digit mobile number.");
            }
        });
    });
</script>
@endsection
