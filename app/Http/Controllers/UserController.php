<?php

namespace App\Http\Controllers;

use App\Models\Property;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\PropertyStatus;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function cartIndex() {
        $user = Auth::user();
        $cartItems = $user->properties()->get();
        return view('cart', compact('cartItems'));
    }

    public function cartInsert(Request $request) {
        
        $user = Auth::user();

        $user->properties()->attach($request->input('id'), ['add_date' => now()]);

        $property = Property::where('id', $request->input('id'))->first();
        $property->property_status_id = PropertyStatus::where('name', 'Added to cart')->first()->id; // Added to cart
        $property->save();

        return redirect()->back()->withSuccess('Item added to cart');
    }

    public function cartDiscard(Request $request) {
        $user = Auth::user();
        $user->properties()->detach($request->input('id'));

        $property = Property::where('id', $request->input('id'))->first();
        if ($property->users()->count() < 1) $property->property_status_id = PropertyStatus::where('name', 'Open')->first()->id; // open
        $property->save();

        return redirect()->back()->withSuccess('Cart item discarded');
    }

    public function cartCheckout() {
        $user = Auth::user();

        // untuk masing-masing property,
        // ubah statusnya jadi 'completed' lalu detach semua user
        $properties = $user->properties()->get();
        foreach ($properties as $property) {
            $property->property_status_id = PropertyStatus::where('name', 'Completed')->first()->id; // completed
            $property->users()->detach();
            $property->save();
        }

        return redirect()->route('home')->withSuccess('Checkout successful');
    }
}
