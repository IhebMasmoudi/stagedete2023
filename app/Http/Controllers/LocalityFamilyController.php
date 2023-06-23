<?php

namespace App\Http\Controllers;

use App\Locality_Family;
use Illuminate\Http\Request;

class LocalityFamilyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {


        $locality_families = Locality_Family::all();
        return view('localityfamily.localityfamily', compact('locality_families'));
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
     */ public function store(Request $request)
    {
        $input = $request->validate([
            'LocalFamily' => 'required|unique:locality_families|string',
            // Add any other validation rules for the input fields
        ]);

        // Check if the locality family already exists in the database
        $existingLocalityFamily = Locality_Family::where('LocalFamily', $input['LocalFamily'])->exists();

        if ($existingLocalityFamily) {
            session()->flash('error', 'Locality Family already exists.');
            return redirect('/locality_family');
        } else {
            Locality_Family::create([
                'LocalFamily' => $input['LocalFamily']
            ]);
            session()->flash('success', 'Locality Family created successfully.');
            return redirect('/locality_family');
        }
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\LocalityFamily  $localityFamily
     * @return \Illuminate\Http\Response
     */
    public function show(Locality_Family $localityFamily)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\LocalityFamily  $localityFamily
     * @return \Illuminate\Http\Response
     */
    public function edit(Locality_Family $localityFamily)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\LocalityFamily  $localityFamily
     * @return \Illuminate\Http\Response
     */
 

     public function update(Request $request)
     {
         $id = $request->FamilyCode;
     
         $this->validate($request, [
             'LocalFamily' => 'required|max:255|unique:locality_families,LocalFamily,' . $id . ',FamilyCode',
         ]);
     
         $localityFamily = Locality_Family::findOrFail($id);
         $localityFamily->LocalFamily = $request->LocalFamily;
         $localityFamily->save();
     
         session()->flash('edit', 'Local Family updated successfully.');
     
         return redirect('/locality_family');
     }
     
        


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\LocalityFamily  $localityFamily
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $FamilyCode = $request->FamilyCode;
        
        Locality_Family::find($FamilyCode)->delete();
        session()->flash('delete', 'Locality Family has been deleted successfully.');
        return redirect('/locality_family');
    }
 
}
