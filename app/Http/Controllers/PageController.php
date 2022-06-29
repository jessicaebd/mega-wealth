<?php

namespace App\Http\Controllers;

use App\Models\Office;
use App\Models\Property;
use App\Models\SalesType;
use Illuminate\Http\Request;
use App\Models\PropertyStatus;

class PageController extends Controller
{
    public function index()
    {
        return view('home');
    }

    public function search()
    {
        $search = request('search');
        $message = "";

        if ($search) {
            $properties = Property::where('location', 'like', '%' . request('search') . '%')
                ->orWhereHas('buildingType', function ($query) {
                    $query->where('name', 'like', '%' . request('search') . '%');
                })
                ->orWhereHas('salesType', function ($query) {
                    $query->where('name', 'like', '%' . request('search') . '%');
                })
                ->paginate(4)
                ->setPath(route('search'))
                ->appends('search', request('search'));
        }

        if ($properties->count() == 0) {
            $properties = Property::paginate(4)
                ->setPath(route('search'))
                ->appends('search', request('search'));
            $message = 'No result found for ' . '\'' . $search . '\'';
        }

        return view('search', compact('search', 'properties', 'message'));
    }

    public function buy()
    {
        $properties = Property::where([
            ['sales_type_id', '=', SalesType::where('name', '=', 'Buy')->first()->id],
            ['property_status_id', '=', PropertyStatus::where('name', '!=', 'Completed')->first()->id],
        ])->paginate(4);
        return view('home.buy', compact('properties'));
    }

    public function rent()
    {
        $properties = Property::where([
            ['sales_type_id', '=', SalesType::where('name', '=', 'Rent')->first()->id],
            ['property_status_id', '=', PropertyStatus::where('name', '!=', 'Completed')->first()->id],
        ])->paginate(4);
        return view('home.rent', compact('properties'));
    }

    public function about()
    {
        $offices = Office::paginate(5);
        return view('home.about', compact('offices'));
    }
}
