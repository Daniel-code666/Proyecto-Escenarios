<?php

namespace App\Http\Controllers;

use App\Models\Stage;
use DateTime;
use Illuminate\Http\Request;
use Carbon\Carbon;
use SebastianBergmann\Environment\Console;

class StageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datos['stages'] = Stage::paginate(5);
        return view('pages.stages.admin', $datos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.stages.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {      
        //$datos = request()->all();
        $datos = request()->except('_token');

        $datosToSend = new Stage();
        $datosToSend = $datos;  
        //$datosToSend->created_at = Carbon::now()->toTimeString();
        //$datosToSend->updated_at = Carbon::now()->toTimeString();
        Stage::insert($datosToSend);
        //return response()->json($datosToSend);
        return view('pages.stages.admin');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Stage  $stage
     * @return \Illuminate\Http\Response
     */
    public function show(Stage $stage)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Stage  $stage
     * @return \Illuminate\Http\Response
     */
    public function edit(Stage $stage)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Stage  $stage
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Stage $stage)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Stage  $stage
     * @return \Illuminate\Http\Response
     */
    public function destroy(Stage $stage)
    {
        //
    }
}
