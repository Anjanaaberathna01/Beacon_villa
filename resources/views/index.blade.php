<!DOCTYPE html>
<html>

<head>
    <title>User Register</title>

    <!-- Navbar CSS -->
    <link rel="stylesheet" href="{{ asset('css/nav.css') }}">
    <!-- Form CSS -->
    <link rel="stylesheet" href="{{ asset('css/register.css') }}">


</head>

<body>

    {{-- Include Navbar at the very top --}}
    @include('layouts.navbar')

    {{-- Form container --}}
    <div class="container mt-5">
        <h2>User Registration</h2>

        {{-- Success message --}}
        @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        {{-- Validation errors --}}
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form method="POST" action="{{ route('register.user') }}">
            @csrf

            <div class="mb-3">
                <label>Name</label>
                <input type="text" name="name" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>Email</label>
                <input type="email" name="email" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>Password</label>
                <input type="password" name="password" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>Confirm Password</label>
                <input type="password" name="password_confirmation" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-primary">Register</button>
        </form>

        <!--user have an account-->
        <p class="text-center mt-3 login-link">
            Already have an account?
            <a href="{{ route('login') }}">Login here</a>
        </p>

    </div>



    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>