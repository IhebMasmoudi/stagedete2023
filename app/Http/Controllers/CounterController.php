<?php

namespace App\Http\Controllers;

use App\counters;
use Illuminate\Http\Request;
use App\counter_types;
use App\locations;


class CounterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $counters = counters::all();
        $locations = locations::all();
        $counter_types = counter_types::all();
        return view('counter.counter', compact('counters', 'locations', 'counter_types'));
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
            'CounterReference' => 'required',
            'LocalCode' => 'required',
            'CounterTypeCode' => 'required',
            // Add any other validation rules for the input fields
        ]);

        // Check if the Counter already exists in the database based on CounterReference
        $existingCounter = counters::where('CounterReference', $input['CounterReference'])->exists();

        if ($existingCounter) {
            session()->flash('error', 'Counter already exists.');
            return redirect('/counter');
        } else {
            // Create the counter record
            // Assuming you have a "counters" model, adjust it accordingly if it has a different name
            counters::create($input);

            session()->flash('Add', 'Counter created successfully.');
            return redirect('/counter');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Counter  $counter
     * @return \Illuminate\Http\Response
     */
    public function show(counters $counter)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Counter  $counter
     * @return \Illuminate\Http\Response
     */
    public function edit(counters $counter)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Counter  $counter
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {

        $counter = counters::findOrFail($request->counterReferenceId);
        $counter_types = counter_types::findOrFail($request->CounterTypeCode);
        $location = locations::findOrFail($request->LocalCode);

        $counter->update([
            'CounterReference' => $request->CounterReference,
            'LocalCode' => $location->LocalCode,
            'CounterTypeCode' => $counter_types->CounterTypeCode,
        ]);

        session()->flash('edit', 'Edit successful');
        return redirect('/counter');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Counter  $counter
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $CounterReferenceid = counters::findOrFail($request->counterReferenceId);

        $CounterReferenceid->delete();

        session()->flash('delete', 'Delete successful');
        return back();
    }


  
}
