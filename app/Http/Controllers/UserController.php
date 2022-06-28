<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function cartIndex() {
        $user = Auth::user();
        $cartItems = $user->properties()->get();
        return view('cart', compact('cartItems'));
    }

    public function cartDiscard(Request $request) {
        $user = Auth::user();
        $user->properties()->detach($request->input('id'));

        return redirect()->back()->withSuccess('Cart item discarded');
    }

    public function cartCheckout() {
        $user = Auth::user();

        //langkah: detach semua user dari masing masing property
        $properties = $user->properties()->get();
        foreach ($properties as $property) {
            $property->users()->detach();
        }

        return redirect()->route('home')->withSuccess('Checkout successful');
    }
}
