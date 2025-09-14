<!-- Include Bootstrap icons -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">

<!-- Include custom CSS -->
<link rel="stylesheet" href="{{ asset('css/nav.css') }}">

<nav class="navbar-custom">
    <!-- Website Name -->
    <a href="{{ route('admin.dashboard') }}" class="brand" style="text-decoration:none">Admin Panel</a>

    <!-- Hamburger Icon (visible only on mobile) -->
    <div class="menu-toggle" id="menu-toggle">
        <i class="bi bi-list"></i>
    </div>

    <!-- Navbar links -->
    <ul id="nav-links">
        <li><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
        <li><a href="{{ route('admin.rooms') }}">Manage Rooms</a></li>
        <li><a href="{{ route('admin.bookings') }}">View Bookings</a></li>
        <li><a href="{{ route('admin.bookings.create') }}">Add Booking</a></li>

        <!-- Admin Logout -->
        <li>
            <form method="POST" action="{{ route('admin.logout') }}">
                @csrf
                <button type="submit" class="btn-logout">
                    <i class="bi bi-box-arrow-right"></i>Logout
                </button>
            </form>
        </li>
    </ul>
</nav>

<!-- Script to toggle menu -->
<script>
    document.getElementById("menu-toggle").addEventListener("click", function () {
        document.getElementById("nav-links").classList.toggle("active");
    });
</script>
