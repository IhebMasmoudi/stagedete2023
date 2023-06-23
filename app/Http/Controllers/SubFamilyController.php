<?php

namespace App\Http\Controllers;

use App\SubFamily;
use Illuminate\Http\Request;

class SubFamilyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $subfamilys=subFamily::all();

        return view('subfamilys.subfamilys',compact('subfamilys'));
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
        //
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
    public function update(Request $request, SubFamily $subFamily)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\SubFamily  $subFamily
     * @return \Illuminate\Http\Response
     */
    public function destroy(SubFamily $subFamily)
    {
        //
    }
}
