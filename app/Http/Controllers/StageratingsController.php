<?php

namespace App\Http\Controllers;

use App\Models\stageratings;
use Illuminate\Http\Request;
use App\Models\Stage;
use Carbon\Carbon;

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

    public function ShowRatings()
    {
        $stages = Stage::all();
        $ratings = stageratings::where("created_at", "<=", Carbon::now()->toDateString())
            ->where("created_at", ">",  $stages[0]['lastRatingProm'])
            ->get();

        $array = Array();

        foreach($stages as $stage){
            $count = 0;
            $average = 0;
            foreach($ratings as $rating){
                if($rating['id_stage'] == $stage['id']){
                    $count++;
                    $average = $average + $rating['rating'];
                }
            }

            $average = $average/$count++;

            array_push($array, $stage->name, $stage->lastRatingProm, $average);
        }

        redirect(Request::url());
    }
}
