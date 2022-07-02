<?php

namespace App\Http\Controllers;

use App\Models\Office;
use App\Models\Property;
use App\Models\SalesType;
use Illuminate\Http\Request;
use App\Models\PropertyStatus;
use Illuminate\Support\Facades\Gate;

class PageController extends Controller
{
    public function index()
    {
        return view('home');
    }

    public function search()
    {
        $search = request('search');

        if ($search) {
            $properties = Property::where('location', 'like', '%' . request('search') . '%')
                ->where('property_status_id', '!=', PropertyStatus::where('name', 'Completed')->first()->id)
                ->orWhereHas('buildingType', function ($query) {
                    $query->where('name', 'like', '%' . request('search') . '%');
                })
                ->orWhereHas('salesType', function ($query) {
                    $query->where('name', 'like', '%' . request('search') . '%');
                });          
        } else {
            $properties = Property::where('property_status_id', '!=', PropertyStatus::where('name', 'Completed')->first()->id);
        }

        $properties = $properties->orderBy('id')
            ->paginate(4)
            ->setPath(route('search'))
            ->appends('search', request('search'));

        // route di tombol searchnya langsung kesini, gausah ke property controller, tapi ntar di navbar, 'manage real estates' nya ga nyala
        // if (Gate::allows('isAdmin')) return view('property.index', compact('properties', 'search'));
        return view('search', compact('search', 'properties'));
    }

    public function buy()
    {
        $properties = Property::where([
            ['sales_type_id', '=', SalesType::where('name', '=', 'Buy')->first()->id],
            ['property_status_id', '!=', PropertyStatus::where('name', 'Completed')->first()->id],
        ])->paginate(4);
        return view('home.buy', compact('properties'));
    }

    public function rent()
    {
        $properties = Property::where([
            ['sales_type_id', '=', SalesType::where('name', '=', 'Rent')->first()->id],
            ['property_status_id', '!=', PropertyStatus::where('name', 'Completed')->first()->id],
        ])->paginate(4);
        return view('home.rent', compact('properties'));
    }

    public function about()
    {
        $offices = Office::paginate(5);
        return view('home.about', compact('offices'));
    }
}
