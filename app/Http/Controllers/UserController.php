<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Property;
use App\Models\Transaction;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\PropertyStatus;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function showTransactionHistory()
    {
        $transactions =  Transaction::where('user_id', Auth::user()->id)->get();
        // Sort transactions by date
        $transactions = $transactions->sortByDesc('transaction_date');

        return view('history', compact('transactions'));
    }

    public function cartIndex()
    {
        $user = Auth::user();
        $cartItems = $user->properties()->get();
        return view('cart', compact('cartItems'));
    }

    public function cartInsert(Request $request)
    {

        $user = Auth::user();

        $user->properties()->attach($request->input('id'), ['add_date' => now()]);

        $property = Property::where('id', $request->input('id'))->first();
        $property->property_status_id = PropertyStatus::where('name', 'Added to cart')->first()->id; // Added to cart
        $property->save();

        return redirect()->back()->withSuccess('Item added to cart');
    }

    public function cartDiscard(Request $request)
    {
        $user = Auth::user();
        $user->properties()->detach($request->input('id'));

        $property = Property::where('id', $request->input('id'))->first();
        if ($property->users()->count() < 1) $property->property_status_id = PropertyStatus::where('name', 'Open')->first()->id; // open
        $property->save();

        return redirect()->back()->withSuccess('Cart item discarded');
    }

    public function cartCheckout(Property $property)
    {
        $user = Auth::user();

        // ubah status jadi completed, hapus dari keranjang semua user
        $property->property_status_id = PropertyStatus::where('name', 'Completed')->first()->id;
        $property->users()->detach();
        $property->save();

        // buat transaction
        $transaction = new Transaction();
        $transaction->id = Str::uuid();
        $transaction->transaction_date = now();
        $transaction->location = $property->location;
        $transaction->price = $property->price;
        $transaction->image = $property->image;
        $transaction->building_type_id = $property->buildingType->id;
        $transaction->sales_type_id = $property->salesType->id;
        $transaction->user_id = $user->id;
        $transaction->property_id = $property->id;
        $transaction->save();

        return redirect()->route('show_cart')->withSuccess('Checkout successful');
    }
}
