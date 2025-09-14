@extends('layouts.app')

@section('content')
<h1>Rooms</h1>

@if(session('success'))
    <div>{{ session('success') }}</div>
@endif

<table border="1">
    <tr>
        <th>Room Number</th>
        <th>Price</th>
        <th>Update Price</th>
    </tr>
   @foreach($rooms as $room)
    <div class="room">
        <h3>Room {{ $room->room_number }}</h3>
        <p>Current Price: {{ number_format($room->price, 2) }} Rs</p>

        <!-- Update Price Form -->
        <form action="{{ route('admin.rooms.update-price', $room->id) }}" method="POST">
            @csrf
            <input type="number" name="price" value="{{ $room->price }}" required>
            <button type="submit">Update Price</button>
        </form>
    </div>
@endforeach

</table>
@endsection
