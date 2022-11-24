<?php

namespace App\Http\Controllers;

use App\Models\stageratings;
use Illuminate\Http\Request;
use App\Models\Stage;
use Carbon\Carbon;
use Illuminate\Support\Facades\Redirect;

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

    public function setRatings(){
        $stages = Stage::all();
        $ratings = stageratings::where("created_at", "<=", Carbon::now()->toDateString())
            ->where("created_at", ">",  $stages[0]['lastRatingProm'])
            ->get();

        foreach($stages as $stage){
            $count = 0;
            $average = 0;
            foreach($ratings as $rating){
                if($rating['id_stage'] == $stage['id']){
                    $count++;
                    $average = $average + $rating['rating'];
                }
            }
            //Si no tiene calificaciones deja la antigua 
            $average = $count == 0 ? $stage['score'] : $average/$count;

            Stage::where('id', $stage['id'])->update(array('score' => $average));
        }

        return Redirect::back()->with('mensaje','¡Calificación actualizada!');
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

        $stagesWhRatings = Array();

        foreach($stages as $stage){
            $count = 0;
            $average = 0;
            foreach($ratings as $rating){
                if($rating['id_stage'] == $stage['id']){
                    $count++;
                    $average = $average + $rating['rating'];
                }
            }
            //Si no tiene calificaciones deja la antigua 
            $average = $count == 0 ? $stage['score'] : $average/$count;

            array_push($stagesWhRatings, [$stage->name, $stage->lastRatingProm, $stage['score'], $average]);
        }

        return view('reports.stageRatings.stageRatingsView', compact('stagesWhRatings'));
    }
}
