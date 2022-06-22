<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cookie;

class LoginController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required|min:8'
        ]);

        if (auth()->attempt($credentials, $request->get('remember'))) {
            // if ($request->has('remember')) {
            //     Cookie::queue('loginCookie', $request->input('email'), 300);
            // }
            return redirect()->route('home');
        }
        return redirect()->back()->with('error', 'Something went wrong');
    }

    public function logout()
    {
        auth()->logout();
        return redirect()->route('login');
    }
}
