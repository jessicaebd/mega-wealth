<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Cookie;

class APIController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|string|min:8',
        ]);

        $user = new User();
        $user->id = Str::uuid();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->role_id = 2;
        $user->save();

        return response()->json([
            'status' => 'Register Success',
        ]);
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string|min:8',
        ]);

        if (!auth()->attempt($credentials)) {
            return response()->json([
                'status' => 'Login Failed',
            ]);
        }

        //! If the customer chooses Remember Me, then the website will save the user’s cookies for 5 minutes. 
        if ($request->remember_me) {
            Cookie::queue(Cookie::make('token', auth()->user()->id, 5));
        }


        return response()->json([
            'status' => 'Login Success',
            'token' => $request->user()->createToken('BearerToken')->accessToken,
        ]);
    }

    public function get_transaction(Request $request)
    {
    }
}
