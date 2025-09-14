@extends('layouts.app')

@section('content')
<h1>Admin Dashboard</h1>

<a href="{{ route('admin.rooms') }}">Manage Rooms</a><br>
<a href="{{ route('admin.bookings') }}">View Bookings</a>
@endsection
