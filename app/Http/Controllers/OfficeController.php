<?php

namespace App\Http\Controllers;

use App\Models\Office;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class OfficeController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $offices = Office::paginate(4);
        return view('office.index', compact('offices'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('office.add');
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
            'name' => 'required|unique:App\Models\Office',
            'address' => 'required|unique:App\Models\Office',
            'contactName' => 'required',
            'phone' => 'required',
            'image' => 'required|file|image|mimes:jpg,jpeg,png|max:10000' //10240
        ]);
    
        $office = new Office();
        $office->id = Str::uuid();
        $office->name = $request->input('name');
        $office->address = $request->input('address');
        $office->contact_name = $request->input('contactName');
        $office->phone = $request->input('phone');
        
        $imageExt = $request->image->getClientOriginalExtension();
        $imageName = substr($office->id, 0, 8)."-".time().$imageExt;
        $p = $request->image->storeAs('public/office', $imageName);
        
        $office->image = $imageName;
        $office->save();

        return redirect()->route('manage-office');
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
    public function edit(Office $office)
    {
        return view('office.edit', compact('office'));
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
            'name' => 'required',
            'address' => 'required',
            'contactName' => 'required',
            'phone' => 'required',
        ]);
        
        $office = Office::find($request->input('id'));
        $office->name = $request->input('name');
        $office->address = $request->input('address');
        $office->contact_name = $request->input('contactName');
        $office->phone = $request->input('phone');

        if( $request->image !== NULL ) {
            $request->validate([
                'image' => 'required|file|image|mimes:jpg,jpeg,png|max:10000' //10240
            ]);

            $imageExt = $request->image->getClientOriginalExtension();
            $imageName = substr($office->id, 0, 8)."-".time().$imageExt;
            $p = $request->image->storeAs('public/office', $imageName);
            $office->image = $imageName;
        }
        
        $office->save();

        return redirect()->route('manage-office');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Office $office)
    {
        // Office::find($id)->delete();
        $office->delete();
        return redirect()->route('manage-office')->withSuccess('Office deleted');
    }
}
