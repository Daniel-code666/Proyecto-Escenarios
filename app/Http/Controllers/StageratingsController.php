<?php

namespace App\Http\Controllers;

use App\Models\stageratings;
use Illuminate\Http\Request;

class StageratingsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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

    public function closePeriod(){
        return view('reports.stageRatings.stageRatingsView');
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
     * @param  \App\Models\stageratings  $stageratings
     * @return \Illuminate\Http\Response
     */
    public function show(stageratings $stageratings)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\stageratings  $stageratings
     * @return \Illuminate\Http\Response
     */
    public function edit(stageratings $stageratings)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\stageratings  $stageratings
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, stageratings $stageratings)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\stageratings  $stageratings
     * @return \Illuminate\Http\Response
     */
    public function destroy(stageratings $stageratings)
    {
        //
    }
}
