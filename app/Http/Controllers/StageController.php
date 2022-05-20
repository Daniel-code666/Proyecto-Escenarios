<?php

namespace App\Http\Controllers;

use App\Models\Stage;
use DateTime;
use Illuminate\Http\Request;
use Carbon\Carbon;
use SebastianBergmann\Environment\Console;
use Illuminate\Support\Facades\Storage;


class StageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $stages['stages'] = Stage::paginate(5);
        return view('pages.stages.admin', $stages);
    }

    public function listStages()
    {
        $stages['stages'] = Stage::paginate(10);
        return view('pages.stages.listStages', $stages);
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
        if($request->hasFile('photo')){
            $datosToSend['photo']=$request->file('photo')->store('uploads','public');
        }
        Stage::insert($datosToSend);
        //return response()->json($datosToSend);
        return redirect('/escenario')->with('mensaje','Escenario creado con éxito.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Stage  $stage
     * @return \Illuminate\Http\Response
     */
    public function show($id/*Stage $stage*/)
    {
        $stage = Stage::find($id);

        return view('pages.stages.guestStagesView', compact('stage'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Stage  $stage
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $stage = Stage::findOrFail($id);
        return view('pages.stages.edit', compact('stage'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Stage  $stage
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $datos = request()->except('_token','_method');

        $datosToSend = new Stage();
        $datosToSend = $datos;  
        //$datosToSend->created_at = Carbon::now()->toTimeString();
        //$datosToSend->updated_at = Carbon::now()->toTimeString();
        if($request->hasFile('photo')){
            $stage = Stage::findOrFail($id);
            Storage::delete('public/'.$stage->photo);
            $datosToSend['photo']=$request->file('photo')->store('uploads','public');
        }
        Stage::where('id','=',$id)->update($datosToSend);
        //return response()->json($datosToSend);
        return redirect('/escenario')->with('mensaje','Escenario editado con éxito.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Stage  $stage
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $stage = Stage::findOrFail($id);
        Storage::delete('public/'.$stage->photo);
        Stage::destroy($id);   
        return redirect('/escenario')->with('mensaje','Escenario eliminado con éxito.');
    }
}
