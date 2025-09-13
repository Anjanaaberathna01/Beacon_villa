<!DOCTYPE html>
<html>

<head>
    <title>User Login</title>

    <!-- Navbar CSS -->
    <link rel="stylesheet" href="{{ asset('css/nav.css') }}">
    <!-- Form CSS -->
    <link rel="stylesheet" href="{{ asset('css/register.css') }}">
    <!-- Bootstrap CSS (optional for styling) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

    @include('layouts.navbar')

    <div class="container mt-5" style="max-width: 500px;">
        <h2 class="mb-4 text-center">User Login</h2>

        <!-- Success Message -->
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <!-- Error Messages -->
        @if($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Login Form -->
        <form method="POST" action="{{ route('login.user') }}">
            @csrf

            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" name="email" id="email" class="form-control" placeholder="Enter your email"
                    required>
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" name="password" id="password" class="form-control"
                    placeholder="Enter your password" required>
            </div>

            <button type="submit" class="btn btn-primary w-100">Login</button>
        </form>

        <p class="text-center mt-3">
            New to our website? <a href="{{ url('/register') }}">Register here</a>
        </p>


    </div>

</body>

</html>