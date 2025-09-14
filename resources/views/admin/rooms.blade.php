
@include("layouts.admin-navbar")

@extends('layouts.app')


@section('content')
<link rel="stylesheet" href="{{ asset('css/admin-rooms.css') }}">

<div class="rooms-container">
    <h1 class="page-title">Rooms</h1>

    @if(session('success'))
        <div class="alert-success">{{ session('success') }}</div>
    @endif

    <table class="rooms-table">
        <thead>
            <tr>
                <th>Room Number</th>
                <th>Price (Rs)</th>
                <th>Update Price</th>
            </tr>
        </thead>
        <tbody>
            @foreach($rooms as $room)
            <tr>
                <td>Room {{ $room->room_number }}</td>
                <td>{{ number_format($room->price, 2) }}</td>
                <td>
                    <form action="{{ route('admin.rooms.update-price', $room->id) }}" method="POST" class="update-form">
                        @csrf
                        <input type="number" name="price" value="{{ $room->price }}" required class="price-input">
                        <button type="submit" class="btn-update">
                            <i class="bi bi-pencil-square"></i> Update
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
