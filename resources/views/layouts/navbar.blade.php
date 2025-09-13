<!-- Include Bootstrap icons -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">

<!-- Include custom CSS -->
<link rel="stylesheet" href="{{ asset('css/nav.css') }}">

<nav class="navbar-custom">
    <!-- Website Name -->
    <a href="{{ url('/') }}" class="brand" style="text-decoration:none">Beacon-Villa</a>

    <!-- Hamburger Icon (visible only on mobile) -->
    <div class="menu-toggle" id="menu-toggle">
        <i class="bi bi-list"></i>
    </div>

    <!-- Navbar links -->
    <ul id="nav-links">
        <li><a href="{{ url('/') }}">Home</a></li>
        <li><a href="{{ url('/#rooms') }}">Rooms</a></li>
        <li><a href="#">Contact Us</a></li>

        @auth
            <li><a href="{{ route('my.bookings') }}">My Bookings</a></li>
        @endauth

        @if(auth()->check())
            <!-- User is logged in: show Logout button -->
            <li>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="btn-logout">
                        <i class="bi bi-box-arrow-right"></i>Logout
                    </button>
                </form>
            </li>
        @else
            <!-- User is not logged in: show Login button -->
            <li><a href="{{ url('/login') }}"><i class="bi bi-box-arrow-in-right"></i>Login</a></li>
        @endif
    </ul>
</nav>

<!-- Script to toggle menu -->
<script>
    document.getElementById("menu-toggle").addEventListener("click", function () {
        document.getElementById("nav-links").classList.toggle("active");
    });
</script>