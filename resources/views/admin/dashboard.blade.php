@include("layouts.admin-navbar")

@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="{{ asset('css/admin-dashboard.css') }}"> {{-- ✅ include here if no head --}}
<div class="admin-dashboard">
    <h1 class="dashboard-title">Admin Dashboard</h1>

    <div class="dashboard-cards">
        <div class="dashboard-card" onclick="goTo('{{ route('admin.rooms') }}')">
            <i class="bi bi-house-door"></i>
            <h2>Manage Rooms</h2>
            <p>Add, edit, or remove room details and set prices.</p>
        </div>

        <div class="dashboard-card" onclick="goTo('{{ route('admin.bookings') }}')">
            <i class="bi bi-calendar-check"></i>
            <h2>View Bookings</h2>
            <p>Check all user bookings and manage reservations.</p>
        </div>
        <div class="dashboard-card" onclick="goTo('{{ route('admin.bookings.create') }}')">
            <i class="bi bi-calendar-check"></i>
            <h2>Add Bookings</h2>
            <p>Check all user bookings and manage reservations.</p>
        </div>
    </div>
</div>

<script>
    function goTo(url) { window.location.href = url; }
</script>
@endsection
