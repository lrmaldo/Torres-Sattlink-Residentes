<?php

namespace App\Http\Controllers;

use App\Models\Torre;
use App\Http\Requests\StoreTorreRequest;
use App\Http\Requests\UpdateTorreRequest;

class TorreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       return view('torres.index');
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
     * @param  \App\Http\Requests\StoreTorreRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTorreRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Torre  $torre
     * @return \Illuminate\Http\Response
     */
    public function show(Torre $torre)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Torre  $torre
     * @return \Illuminate\Http\Response
     */
    public function edit(Torre $torre)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateTorreRequest  $request
     * @param  \App\Models\Torre  $torre
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTorreRequest $request, Torre $torre)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Torre  $torre
     * @return \Illuminate\Http\Response
     */
    public function destroy(Torre $torre)
    {
        //
    }
}
