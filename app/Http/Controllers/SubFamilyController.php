<?php

namespace App\Http\Controllers;

use App\SubFamily;
use Illuminate\Http\Request;
use App\Locality_Family;

class SubFamilyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    { {
            #$locality_families = Locality_Family::all();
            $sub_familys = SubFamily::all();
            return view('subfamily.subfamily', compact('sub_familys'));

            #return view('subfamily.subfamily', compact('locality_families', 'sub_familys'));
        }
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
            'SubFamily' => 'required|unique:sub_families',
            'LocalFamily' => 'required',

            // Add any other validation rules for the input fields
        ]);
    
        // Check if the SubFamily already exists in the database
        $existingSubFamily = SubFamily::where('SubFamily', $input['SubFamily'])->exists();
    
        if ($existingSubFamily) {
            session()->flash('error', 'SubFamily already exists.');
            return redirect('/subfamily');
        } else {
            SubFamily::create([
                'SubFamily' => $input['SubFamily'],
                'LocalFamily' => $input['LocalFamily'],
                #'FamilyCode' => $input['FamilyCode'],
            ]);
    
            session()->flash('Add', 'SubFamily created successfully.');
            return redirect('/subfamily');
        }
    }
    

    /**
     * Display the specified resource.
     *
     * @param  \App\SubFamily  $subFamily
     * @return \Illuminate\Http\Response
     */
    public function show(SubFamily $subFamily)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\SubFamily  $subFamily
     * @return \Illuminate\Http\Response
     */
    public function edit(SubFamily $subFamily)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\SubFamily  $subFamily
     * @return \Illuminate\Http\Response
     */
   /* public function update(Request $request)
    {
        $subFamily = SubFamily::findOrFail($request->SubFamilyCode);
        $localFamily = Locality_Family::where('LocalFamily', $request->LocalFamily)->first();
    
        if ($localFamily) {
            $subFamily->update([
                'SubFamily' => $request->SubFamily,
                'FamilyCode' => $localFamily->FamilyCode,
            ]);
    
            session()->flash('edit', 'Edit successful');
            return back();
        } else {
            // Handle the case when the LocalFamily doesn't exist
            return back()->withErrors('LocalFamily does not exist.');
        }
    }*/

    public function update(Request $request)
    {
        $subFamily = SubFamily::findOrFail($request->SubFamilyCode);
    
        
            $subFamily->update([
                'SubFamily' => $request->SubFamily,
                'LocalFamily' => $request->LocalFamily,
            ]);
    
            session()->flash('edit', 'Edit successful');
            return back();
     
    }
    
    

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\SubFamily  $subFamily
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
{
    $subFamily = SubFamily::findOrFail($request->SubFamilyCode);
    
    // Perform any additional checks or validations before deleting the record

    $subFamily->delete();

    session()->flash('delete', 'Delete successful');
    return back();
}

}
