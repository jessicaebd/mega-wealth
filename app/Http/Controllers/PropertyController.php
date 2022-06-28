<?php

namespace App\Http\Controllers;

use App\Models\Property;
use App\Models\PropertyStatus;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class PropertyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $properties = Property::paginate(4);
        return view('property.index', compact('properties'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('property.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
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
        $property->property_status_id = PropertyStatus::where('name', 'open')->first()->id;
        $property->building_type_id = $request->input('buildingType');
        $property->sales_type_id = $request->input('salesType');

        $imageExt = $request->image->getClientOriginalExtension();
        $imageName = substr($property->id, 0, 8)."-".time().$imageExt;
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

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Property $property)
    {
        return view('property.edit', compact('property'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
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

        if( $request->image !== NULL ) {
            $request->validate([
                'image' => 'required|file|image|mimes:jpg,jpeg,png|max:10000' //10240
            ]);

            $imageExt = $request->image->getClientOriginalExtension();
            $imageName = substr($property->id, 0, 8)."-".time().$imageExt;
            $p = $request->image->storeAs('public/property', $imageName);
            $property->image = $imageName;
        }
        
        $property->save();

        return redirect()->route('manage_property')->withSuccess('Property data updated');
    }

    public function finish(Request $request) {
        // @dd($request);
        $property = Property::find($request->input('id'));
        $property->property_status_id = PropertyStatus::where('name', 'completed')->first()->id;
        $property->save();

        // hapus entry pivot table yg mengandung property tsb
        $property->users()->detach();
        return redirect()->back()->withSuccess('Property transaction completed');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Property $property)
    {
        $property->users()->detach();
        $property->delete();
        return redirect()->back()->withSuccess('Property deleted');
    }
}
