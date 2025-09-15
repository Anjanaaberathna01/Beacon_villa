@extends('layouts.app')
@include("layouts.admin-navbar")

@section('styles')
<link rel="stylesheet" href="{{ asset('css/admin-booked-room.css') }}">
@endsection

@section('content')
<div class="admin-container">
    <h1>Create Booking (Admin)</h1>

    {{-- Success message --}}
    @if(session('success'))
        <div class="alert-success">{{ session('success') }}</div>
    @endif

    {{-- Error messages --}}
    @if ($errors->any())
        <div class="alert-error">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form id="bookingForm" method="POST" action="{{ route('admin.bookings') }}">
        @csrf

        <div class="form-group">
            <label for="room_number">Room</label>
            <select name="room_number" id="room_number" required>
                @foreach($rooms as $room)
                    <option value="{{ $room->room_number }}">
                        Room {{ $room->room_number }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" id="name" required>
        </div>

        <div class="form-group">
            <label for="mobile_number">Mobile Number</label>
            <input type="text" name="mobile_number" id="mobile_number" required>
        </div>

        <div class="form-group">
            <label for="booking_date">Booking Date</label>
            <input type="date" name="booking_date" id="booking_date" required>
        </div>

        <button type="submit" class="btn-submit">Save</button>
    </form>
</div>

{{-- JavaScript validation --}}
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const today = new Date().toISOString().split("T")[0];
        document.getElementById("booking_date").setAttribute("min", today);

        document.getElementById("bookingForm").addEventListener("submit", function (e) {
            const mobile = document.getElementById("mobile_number").value;
            if (!/^[0-9]{10}$/.test(mobile)) {
                e.preventDefault();
                alert("Please enter a valid 10-digit mobile number.");
            }
        });
    });
</script>
@endsection
