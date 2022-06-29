<?php

namespace App\Http\Controllers;

use App\Models\Property;
use App\Models\SalesType;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\PropertyStatus;

class PropertyController extends Controller
{
    public function index()
    {
        $properties = Property::paginate(4);
        return view('property.index', compact('properties'));
    }

    public function create()
    {
        return view('property.add');
    }

    public function store(Request $request)
    {
        $request->validate([
            'buildingType' => 'required|exists:App\Models\BuildingType,id',
            'salesType' => 'required|exists:App\Models\SalesType,id',
            'price' => 'required|min:1',
            'location' => 'required|unique:App\Models\Property',
            'image' => 'required|file|image|mimes:jpg,jpeg,png|max:10000' //10240
        ]);

        $property = new Property();
        $property->id = Str::uuid();
        $property->location = $request->input('location');
        $property->price = $request->input('price');
        $property->property_status_id = PropertyStatus::where('name', 'Open')->first()->id;
        $property->building_type_id = $request->input('buildingType');
        $property->sales_type_id = $request->input('salesType');

        $imageExt = $request->image->getClientOriginalExtension();
        $imageName = substr($property->id, 0, 8) . "-" . time() . $imageExt;
        $p = $request->image->storeAs('public/property', $imageName);

        $property->image = $imageName;
        $property->save();

        return redirect()->route('manage_property')->withSuccess('New property added');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    public function edit(Property $property)
    {
        return view('property.edit', compact('property'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'buildingType' => 'required|exists:App\Models\BuildingType,id',
            'salesType' => 'required|exists:App\Models\SalesType,id',
            'price' => 'required|min:1',
            'location' => 'required'
        ]);

        $property = Property::find($request->input('id'));
        $property->location = $request->input('location');
        $property->price = $request->input('price');
        $property->building_type_id = $request->input('buildingType');
        $property->sales_type_id = $request->input('salesType');

        if ($request->image !== NULL) {
            $request->validate([
                'image' => 'required|file|image|mimes:jpg,jpeg,png|max:10000' //10240
            ]);

            $imageExt = $request->image->getClientOriginalExtension();
            $imageName = substr($property->id, 0, 8) . "-" . time() . $imageExt;
            $p = $request->image->storeAs('public/property', $imageName);
            $property->image = $imageName;
        }

        $property->save();

        return redirect()->route('manage_property')->withSuccess('Property data updated');
    }

    public function finish(Request $request)
    {
        // @dd($request);
        $property = Property::find($request->input('id'));
        $property->property_status_id = PropertyStatus::where('name', 'Completed')->first()->id;
        $property->save();

        // hapus entry pivot table yg mengandung property tsb
        $property->users()->detach();
        return redirect()->back()->withSuccess('Property transaction completed');
    }

    public function destroy(Property $property)
    {
        $property->users()->detach();
        $property->delete();
        return redirect()->back()->withSuccess('Property deleted');
    }
}
