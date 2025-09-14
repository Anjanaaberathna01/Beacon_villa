@extends('layouts.app')

@section('content')
<h1>Bookings</h1>

@if(session('success'))
    <div>{{ session('success') }}</div>
@endif

<table border="1">
    <tr>
        <th>Booking ID</th>
        <th>Room Number</th>
        <th>User</th>
        <th>Mobile Number</th>
        <th>Actions</th>
    </tr>
    @foreach($bookings as $booking)
    <tr>
        <td>{{ $booking->id }}</td>
        <td>{{ $booking->room->room_number }}</td>
        <td>{{ $booking->name }}</td>
        <td>{{ $booking->mobile_number}}</td>
        <td>
            <form action="{{ route('admin.bookings.delete', $booking->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" onclick="return confirm('Are you sure?')">Delete</button>
            </form>
        </td>
    </tr>
    @endforeach
</table>
@endsection
