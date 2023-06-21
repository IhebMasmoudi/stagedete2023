<?php

namespace App\Http\Controllers;

use App\district;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

class DistrictController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $districts=district::all();

        return view('district.district',compact('districts'));
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
        'district_name' => 'required|unique:districts|string',
        'description' => 'required|string',
    ]);

    // Check if the district already exists in the database
    $existingDistrict = district::where('district_name', $input['district_name'])->exists();

    if ($existingDistrict) {
        session()->flash('error', 'District already exists.');
        return redirect('/districts');
    }
    else{
        district::create([
            'district_name' => $input['district_name'],
            'description' => $input['description'],
            'Created_by' => Auth::user()->name,
        ]);
        session()->flash('Add', 'district Created successfully .');
        return redirect('/districts');
    }  
}
    

    /**
     * Display the specified resource.
     *
     * @param  \App\district  $district
     * @return \Illuminate\Http\Response
     */
    public function show(district $district)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\district  $district
     * @return \Illuminate\Http\Response
     */
    public function edit(district $district)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\district  $district
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, district $district)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\district  $district
     * @return \Illuminate\Http\Response
     */
    public function destroy(district $district)
    {
        //
    }
}
