@extends('layouts.app')

@section('content')
<h1>All Rooms</h1>
<div class="rooms-list">
    @foreach($rooms as $room)
        <div class="room-item">
            <h3>Room {{ $room->room_number }}</h3>
            <a href="{{ route('rooms.show', $room->id) }}">
                <button>View / Book</button>
            </a>
        </div>
    @endforeach
</div>
@endsection
