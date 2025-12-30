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

        <div class="text-center my-3">
            <span class="text-muted">OR</span>
        </div>

        <!-- Google Login Button -->
        <a href="{{ route('login.google') }}" class="btn btn-outline-danger w-100 d-flex align-items-center justify-content-center">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-google me-2" viewBox="0 0 16 16">
                <path d="M15.545 6.558a9.4 9.4 0 0 1 .139 1.626c0 2.434-.87 4.492-2.384 5.885h.002C11.978 15.292 10.158 16 8 16A8 8 0 1 1 8 0a7.7 7.7 0 0 1 5.352 2.082l-2.284 2.284A4.35 4.35 0 0 0 8 3.166c-2.087 0-3.86 1.408-4.492 3.304a4.8 4.8 0 0 0 0 3.063h.003c.635 1.893 2.405 3.301 4.492 3.301 1.078 0 2.004-.276 2.722-.764h-.003a3.7 3.7 0 0 0 1.599-2.431H8v-3.08z"/>
            </svg>
            Continue with Google
        </a>

        <p class="text-center mt-3">
            New to our website? <a href="{{ url('/register') }}">Register here</a>
        </p>

        <!-- Add below the form -->
<p class="text-center mt-3">
    Are you an admin? <a href="{{ route('admin.login.form') }}" class="btn btn-sm btn-warning">Admin Login</a>
</p>

    </div>

</body>

</html>
