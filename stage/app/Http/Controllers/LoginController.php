<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        if (auth()->check()) {
            // If the user is authenticated, redirect to the 'layout/header' route
            return redirect()->route('layout');
        } else {
            // If the user is not authenticated, return the 'login' view
            return view('login');
        }
    }

    public function layout()
    {
        if (session()->has('user_email')) {
            return view('layout.header');
        } else {
            return view('login');
        }
    }

    public function login(Request $request)
    {
        $email = $request->input('email');
        $password = $request->input('password');
        $response = Http::post('https://daylogs.in/APIs/employee/login', [
            'email' => $email,
            'password' => $password
        ]);
        if ($response->ok()) {
            $userData = $response->json();
            session(['user_email' => $email]);
            return redirect()->route('userlist');
        } else {
            return back()->with('error', 'Invalid credentials. Please try again.');
        }
    }
    
    public function logout(Request $request)
    {
        // Clear the user's session data
        $request->session()->flush();

        // Redirect to the login page
        return redirect()->route('login');
    }
    public function register()
    {
        return view('register');
    }

    public function registerpost(Request $request)
    {
        // Extract input data from the request
        $name = $request->input('name');
        $email = $request->input('email');
        $contact = $request->input('contact');
        $password = $request->input('password');

        // Make a POST request to your registration API endpoint
        $response = Http::post('https://daylogs.in/APIs/employee/signup.php', [
            'name' => $name,
            'email' => $email,
            'contact' => $contact,
            'password' => $password
        ]);

        if ($response->ok()) {
            // If the registration is successful, redirect to the login page
            return view('login', ['success' => 'Registration successful. Please log in.']);
        } else {
            // If registration fails, redirect back with an error message
            return back()->with('error', 'Registration failed. Please try again.');
        }
    }
    public function userlist()
    {
        if (session()->has('user_email')) { 
            return view('userlist');
        } else {
            return view('login');
        }
    }
}
