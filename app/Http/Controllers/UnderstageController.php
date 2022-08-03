<?php

namespace App\Http\Controllers;

use App\Models\Understage;
use Illuminate\Http\Request;
use App\Models\Disciplines;
use App\Models\Stage;
use Illuminate\Support\Facades\Storage;
use App\Models\MiscListStates;
use PDF;

class UnderstageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $underStages['underStages'] = Understage::join('disciplines', 
        'disciplines.disciplineId', '=', 'understages.discipline_understg')
        ->join('stages', 'stages.id', '=', 'understages.idStage')
        ->paginate(10);

        $stages['stages'] = Stage::get();

        return view('pages.Understages.underStAdmin', $underStages, $stages);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $disciplines = Disciplines::all();
        $stages = Stage::all();
        $states = MiscListStates::where("tableParent", "=", 'stages')->get();
        return view('pages.Understages.underStCreate', compact('disciplines', 'stages', 'states'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $datos = request()->except('_token');

        $datosToSend = new Understage();
        $datosToSend = $datos;  
        // $datosToSend->created_at = Carbon::now()->toTimeString();
        // $datosToSend->updated_at = Carbon::now()->toTimeString();
        if($request->hasFile('photo_understg')){
            $datosToSend['photo_understg']=$request->file('photo_understg')->store('uploads','public');
        }
        Understage::insert($datosToSend);
        //return response()->json($datosToSend);
        return redirect('/understage')->with('mensaje','Sub escenario creado con éxito.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Understage  $understage
     * @return \Illuminate\Http\Response
     */
    public function show($idUnderstage)
    {
        $underStageDef = Understage::find($idUnderstage);

        $stage = Understage::join('disciplines', 'disciplines.disciplineId', '=', 'understages.discipline_understg')
                ->where('idUnderstage', $underStageDef->idUnderstage)
                ->join('stages', 'stages.id', '=', 'understages.idStage')
                ->where('idUnderstage', $underStageDef->idUnderstage)
                ->first();

        return view('pages.Understages.underStView', compact('stage'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Understage  $understage
     * @return \Illuminate\Http\Response
     */
    public function edit($idUnderstage)
    {
        $disciplines = Disciplines::all();
        $stages = Stage::all();
        $underStage = Understage::findOrFail($idUnderstage);
        $states = MiscListStates::where("tableParent", "=", 'stages')->get();
        return view('pages.Understages.underStEdit', compact('underStage', 'disciplines', 'stages', 'states'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Understage  $understage
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $idUnderstage)
    {
        $data = request()->except('_token','_method');

        $dataToSend = new Understage();
        $dataToSend = $data;  
        //$datosToSend->created_at = Carbon::now()->toTimeString();
        //$datosToSend->updated_at = Carbon::now()->toTimeString();
        if($request->hasFile('photo_understg')){
            $underStage = Understage::findOrFail($idUnderstage);
            Storage::delete('public/'.$underStage->photo_understg);
            $dataToSend['photo_understg']=$request->file('photo_understg')->store('uploads','public');
        }
        Understage::where('idUnderstage','=',$idUnderstage)->update($dataToSend);
        //return response()->json($datosToSend);
        return redirect('/understage')->with('mensaje','Escenario editado con éxito.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Understage  $understage
     * @return \Illuminate\Http\Response
     */
    public function destroy($idUnderstage)
    {
        $underStage = Understage::findOrFail($idUnderstage);
        Storage::delete('public/'.$underStage->photo_understg);
        Understage::destroy($idUnderstage);   
        return redirect('/understage')->with('mensaje','Escenario eliminado con éxito.');
    }

    public function listUnderSt(){
        $underStages['underStages'] = Understage::join('disciplines', 
        'disciplines.disciplineId', '=', 'understages.discipline_understg')
        ->join('stages', 'stages.id', '=', 'understages.idStage')
        ->paginate(10);

        return view('pages.Understages.listUnderSt', $underStages);
    }

    /**
     * Generar reporte general
     */
    public function pdfUnderstageGeneral($idUnderstage){
        $underStageDef = Understage::find($idUnderstage);

        $stage = Understage::join('disciplines', 'disciplines.disciplineId', '=', 'understages.discipline_understg')
                ->where('idUnderstage', $underStageDef->idUnderstage)
                ->join('stages', 'stages.id', '=', 'understages.idStage')
                ->where('idUnderstage', $underStageDef->idUnderstage)
                ->first();

        $pdf = app('dompdf.wrapper');
        $contxt = stream_context_create([
            'ssl' => [
                'verify_peer' => FALSE,
                'verify_peer_name' => FALSE,
                'allow_self_signed' => TRUE,
            ]
        ]);

        $pdf = PDF::setOptions(['isHTML5ParserEnabled' => true, 'isRemoteEnabled' => true]);
        $pdf->getDomPDF()->setHttpContext($contxt);

        $pdf->loadView('pages.reports.ReporteUnderStGen', compact('stage'))->setOptions(['defaultFont' => 'sans-serif']);
        
        return $pdf->download($stage->name.'.pdf');
    }
}
