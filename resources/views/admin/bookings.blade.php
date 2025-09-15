
@include("layouts.admin-navbar")

@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="{{ asset('css/admin-bookings.css') }}">

<div class="bookings-container">
    <h1 class="page-title">Bookings</h1>

    @if(session('success'))
        <div class="alert-success">{{ session('success') }}</div>
    @endif

    <table class="bookings-table">
        <thead>
            <tr>
                <th>Booking Date</th>
                <th>Room Number</th>
                <th>User Name</th>
                <th>Mobile Number</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($bookings as $booking)
            <tr>
                <td>{{ $booking->booking_date }}</td>
                <td>Room {{ $booking->room->room_number }}</td>
                <td>{{ $booking->name }}</td>
                <td>{{ $booking->mobile_number }}</td>
                <td>
                    <form action="{{ route('admin.bookings.delete', $booking->id) }}" method="POST" class="delete-form">
                        @csrf
                        @method('DELETE')
                        <button type="button" class="btn-delete" onclick="confirmDelete(this)">
                            <i class="bi bi-trash"></i> Delete
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<!-- Delete Confirmation Script -->
<script>
    function confirmDelete(button) {
        if (confirm("Are you sure you want to delete this booking?")) {
            button.closest("form").submit();
        }
    }
</script>
@endsection
