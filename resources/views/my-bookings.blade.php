<!DOCTYPE html>
<html>

<head>
    <title>My Bookings</title>
    <link rel="stylesheet" href="{{ asset('css/nav.css') }}">
    <link rel="stylesheet" href="{{ asset('css/my-bookings.css') }}">

    <!-- FullCalendar CSS -->
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.7/index.global.min.css" rel="stylesheet">

    <style>
        #calendar {
            max-width: 900px;
            margin: 40px auto;
        }

        table {
            width: 90%;
            margin: 30px auto;
            border-collapse: collapse;
        }

        table th,
        table td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: center;
        }

        table th {
            background-color: #f4f4f4;
        }

        .cancel {
            background-color: #e74c3c;
            color: #fff;
            border: none;
            padding: 6px 12px;
            cursor: pointer;
        }

        .cancel:hover {
            background-color: #c0392b;
        }

        .text-muted {
            color: gray;
        }

        .alert {
            width: 90%;
            margin: 10px auto;
            padding: 10px;
            border-radius: 5px;
        }

        .alert-success {
            background-color: #d4edda;
            color: #155724;
        }

        .alert-danger {
            background-color: #f8d7da;
            color: #721c24;
        }
    </style>
</head>

<body>
    @include('layouts.navbar')

    <div class="container">
        <h2>My Bookings</h2>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <!-- Calendar -->
        <div id="calendar"></div>

        <!-- Booking Table -->
        @if($bookings->count() > 0)
            <table>
                <thead>
                    <tr>
                        <th>Room</th>
                        <th>Date</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @php $today = \Carbon\Carbon::today(); @endphp
                    @foreach($bookings as $booking)
                        @php
                            $bookingDate = \Carbon\Carbon::parse($booking->booking_date);
                        @endphp
                        <tr>
                            <td>{{ $booking->room->room_number }}</td>
                            <td>{{ $booking->booking_date }}</td>
                            <td>
                                @if($bookingDate->lt($today))
                                    <span class="text-muted">View Only</span>
                                @else
                                    <form method="POST" action="{{ route('bookings.cancel', $booking->id) }}">
                                        @csrf
                                        @method('DELETE')
                                        <button class="cancel" onclick="return confirm('Cancel this booking?');">Cancel</button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p style="text-align: center;">You have no bookings yet.</p>
        @endif
    </div>

    <!-- FullCalendar JS -->
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.7/index.global.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const calendarEl = document.getElementById('calendar');

            const calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                height: 600,
                events: [
                    @foreach($bookings as $booking)
                        {
                            title: 'Room {{ $booking->room->room_number }}',
                            start: '{{ $booking->booking_date }}',
                            color: '{{ \Carbon\Carbon::parse($booking->booking_date)->isPast() ? "#95a5a6" : "#27ae60" }}'
                        },
                    @endforeach
                ],
                eventClick: function(info) {
                    alert('Booked: ' + info.event.title + '\nDate: ' + info.event.startStr);
                }
            });

            calendar.render();
        });
    </script>
        @include('layouts.footer')
</body>

</html>
