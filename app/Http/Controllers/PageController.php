<?php

namespace App\Http\Controllers;

use App\Models\Property;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function index()
    {
        return view('home');
    }

    public function search()
    {
        if (request('search')) {
            $properties = Property::where('location', 'like', '%' . request('search') . '%')
                ->orWhereHas('buildingType', function ($query) {
                    $query->where('name', 'like', '%' . request('search') . '%');
                })
                ->orWhereHas('salesType', function ($query) {
                    $query->where('name', 'like', '%' . request('search') . '%');
                })
                ->get();
        } else {
            $properties = Property::all();
        }


        $search = request('search');
        return view('search', compact('properties', 'search'));
    }
}
