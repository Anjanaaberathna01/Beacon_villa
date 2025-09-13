<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    // Show admin login form
    public function showLoginForm()
    {
        return view('admin.login'); // We'll create this view next
    }

    // Handle admin login
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::guard('admin')->attempt($credentials)) {
            return redirect()->route('admin.dashboard'); // Admin dashboard route
        }

        return back()->withErrors(['email' => 'Invalid credentials'])->withInput();
    }
}
