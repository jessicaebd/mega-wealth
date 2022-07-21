<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;

class LoginController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            if ($request->input('remember') !== NULL) Cookie::queue('LoginCookie', $request->input('email'), 5);
            else Cookie::queue(Cookie::forget('LoginCookie'));
            if (Auth::user()->role->name == 'admin') return redirect()->route('home');
            return redirect()->intended('/');
        }

        return redirect()->back()->with('error', 'Login Failed!');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login_page');
    }
}
