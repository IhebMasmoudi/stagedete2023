<?php

namespace App\Http\Controllers;

use App\counter_types;
use Illuminate\Http\Request;

class CounterTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $counter_types = counter_types::all();
        return view('countertype.countertype', compact('counter_types'));
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
            'CounterType' => 'required|unique:counter_types|string',
        ]);

        // Check if the counter type already exists in the database
        $existingCounterType = counter_types::where('CounterType', $input['CounterType'])->exists();

        if ($existingCounterType) {
            session()->flash('error', 'Counter type already exists.');
            return redirect('/countertype');
        } else {
            counter_types::create([
                'CounterType' => $input['CounterType'],
            ]);
            session()->flash('Add', 'Counter type created successfully.');
            return redirect('/countertype');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\counter_types  $counterType
     * @return \Illuminate\Http\Response
     */
    public function show(counter_types $counterType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\counter_types  $counterType
     * @return \Illuminate\Http\Response
     */
    public function edit(counter_types $counterType)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\counter_types  $counterType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $id = $request->CounterTypeCode;
        $this->validate($request, [
            'CounterType' => 'required|max:255|unique:counter_types,CounterType,' . $id . ',CounterType',
        ]);
        $counter_types = counter_types::findOrFail($id);
        $counter_types->CounterType = $request->CounterType;
        $counter_types->save();
        session()->flash('edit', 'Counter type updated successfully.');
        return redirect('/countertype');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\counter_types  $counterType
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $CounterTypeCode = $request->CounterTypeCode;
        
        counter_types::find($CounterTypeCode)->delete();
        session()->flash('delete', 'Counter Types has been deleted successfully.');
        return redirect('/countertype');
    }
}
