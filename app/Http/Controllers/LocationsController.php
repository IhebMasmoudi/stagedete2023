<?php

namespace App\Http\Controllers;

use App\locations;
use App\District;
use App\SubFamily;
use Illuminate\Http\Request;

class LocationsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $locations = locations::all();
        $subFamilies = SubFamily::all();
        $districts = District::all();
        return view('location.location', compact('locations', 'subFamilies', 'districts'));
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->validate([
            'LocalLabel' => 'required',
            'LocalAddress' => 'required',
            'DistrictCode' => 'required',
            'SubFamilyCode' => 'required',
            // Add any other validation rules for the input fields
        ]);

        // Check if the Location already exists in the database based on LocalLabel
        $existingLocation = locations::where('LocalLabel', $input['LocalLabel'])->exists();

        if ($existingLocation) {
            session()->flash('error', 'Location already exists.');
            return redirect('/location');
        } else {
            locations::create($input);

            session()->flash('Add', 'Location created successfully.');
            return redirect('/location');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Locations  $locations
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Locations  $locations
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Locations  $locations
     * @return \Illuminate\Http\Response
     */

    public function update(Request $request)
    {
        $location = locations::findOrFail($request->LocalCode);

        $district = District::findOrFail($request->DistrictCode);
        $subFamily = SubFamily::findOrFail($request->SubFamilyCode);

        $location->update([
            'LocalLabel' => $request->LocalLabel,
            'LocalAddress' => $request->LocalAddress,
            'DistrictCode' => $district->id,
            'SubFamilyCode' => $subFamily->SubFamilyCode,
        ]);

        session()->flash('edit', 'Edit successful');
        return redirect('/location');
    }




    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Locations  $locations
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
{
    $location = locations::findOrFail($request->LocalCode);
    $location->delete();

    session()->flash('delete', 'Delete successful');
    return back();
}
}
