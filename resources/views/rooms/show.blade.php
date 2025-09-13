<!DOCTYPE html>
<html>

<head>
    <title>Room {{ $room->room_number ?? 'Details' }}</title>
    <link rel="stylesheet" href="{{ asset('css/nav.css') }}">
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
    <link rel="stylesheet" href="{{ asset('css/rooms.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

    <!-- FullCalendar CSS -->
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/index.global.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #f5f5f5;
            font-family: Arial, sans-serif;
        }

        .container {
            max-width: 1200px;
            margin: 20px auto;
            padding: 0 15px;
        }

        h2 {
            text-align: center;
            margin-bottom: 30px;
            color: #333;
        }

        .rooms-container {
            display: flex;
            gap: 40px;
            flex-wrap: wrap;
        }

        /* Booking form (left) */
        .room-left {
            flex: 1;
            min-width: 300px;
            background: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .room-left .form-group {
            margin-bottom: 15px;
        }

        .room-left label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        .room-left input {
            width: 100%;
            padding: 8px 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
            box-sizing: border-box;
        }

        .booking-buttons {
            margin-top: 15px;
        }

        .btn-available {
            background-color: #27ae60;
            color: #fff;
            padding: 10px 20px;
            border: none;
            cursor: pointer;
            border-radius: 5px;
            margin-right: 10px;
        }

        .btn-mybooking {
            background-color: #2980b9;
            color: #fff;
            padding: 10px 20px;
            border: none;
            cursor: pointer;
            border-radius: 5px;
        }

        .login-prompt a {
            color: #2980b9;
            text-decoration: none;
            font-weight: bold;
        }

        /* Calendar (right) */
        .room-right {
            flex: 1;
            min-width: 300px;
            background: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        #calendar {
            max-width: 100%;
            margin: 0 auto;
        }

        /* Responsive */
        @media (max-width: 992px) {
            .rooms-container {
                flex-direction: column;
            }
        }
    </style>
</head>

<body>
    @include('layouts.navbar')

    <div class="container">
        @if(!$room)
        <div class="alert alert-danger">
            Room not found.
        </div>
        @else
        <h2>Room {{ $room->room_number }}</h2>

        @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <div class="rooms-container">
            <!-- Left side: Booking form -->
            <div class="room-left">
                @auth
                <form method="POST" action="{{ route('rooms.book', $room->id) }}" id="bookingForm">
                    @csrf
                    <div class="form-group">
                        <label>Name:</label>
                        <input type="text" name="name" value="{{ Auth::user()->name }}" required>
                    </div>
                    <div class="form-group">
                        <label>Email:</label>
                        <input type="email" name="email" value="{{ Auth::user()->email }}" required>
                    </div>
                    <div class="form-group">
                        <label>Mobile:</label>
                        <input type="text" name="mobile_number" required>
                    </div>

                    <input type="hidden" name="booking_date" id="booking_date" required>
                    <p><strong>Selected Date:</strong> <span id="selected_date_text">None</span></p>

                    <div class="booking-buttons">
                        <button type="submit" class="btn-available">Confirm Booking</button>
                        @if($room->bookings->where('user_id', auth()->id())->count() > 0)
                        <a href="{{ route('my.bookings') }}">
                            <button type="button" class="btn-mybooking">My Bookings</button>
                        </a>
                        @endif
                    </div>
                </form>
                @else
                <p class="login-prompt">You must <a href="{{ route('login') }}">log in</a> to book this room.</p>
                @endauth
            </div>

            <!-- Right side: Calendar -->
            <div class="room-right">
                <div id="calendar"></div>
            </div>
        </div>
        @endif
    </div>

    <!-- FullCalendar JS -->
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/index.global.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            @if($room)
            let calendarEl = document.getElementById('calendar');

            let bookings = @json($room->bookings->map(fn($b) => [
                'title' => 'Booked',
                'start' => $b->booking_date
            ]));

            let bookedDates = bookings.map(b => b.start);
            let today = new Date().toISOString().split('T')[0];

            let calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                selectable: true,
                events: bookings,
                validRange: { start: today },
                dateClick: function (info) {
                    if (info.dateStr < today) {
                        alert("You cannot book past dates.");
                        return;
                    }
                    if (bookedDates.includes(info.dateStr)) {
                        alert("This date is already booked.");
                        return;
                    }
                    document.getElementById('booking_date').value = info.dateStr;
                    document.getElementById('selected_date_text').innerText = info.dateStr;
                },
                eventColor: 'red',
                eventDisplay: 'background'
            });

            calendar.render();
            @endif
        });
    </script>
</body>

</html>
