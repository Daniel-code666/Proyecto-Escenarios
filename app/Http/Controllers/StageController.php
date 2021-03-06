<?php

namespace App\Http\Controllers;

use App\Models\Stage;
use App\Models\Disciplines;
use App\Models\MiscListStates;
use App\Models\Resources;
use App\Models\Understage;
use App\Models\warehouse;
use DateTime;
use Illuminate\Http\Request;
use Carbon\Carbon;
use SebastianBergmann\Environment\Console;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use PDF;

class StageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $stages['stages'] = Stage::join('disciplines', 'disciplines.disciplineId', '=', 'stages.discipline')->get();
        $disciplines['disciplines'] = Disciplines::get();
        $misclist['misclist'] = MiscListStates::where("tableParent", "=", 'stages')->get();

        return view('pages.stages.admin', $stages)->with('disciplines', $disciplines)->with('misclist', $misclist);
    }

    public function listStages()
    {
        //$stages['stages'] = Stage::paginate(10);
        $stages['stages'] = Stage::join('disciplines', 'disciplines.disciplineId', '=', 'stages.discipline')
            ->paginate(10);

        return view('pages.stages.listStages', $stages);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $disciplines = Disciplines::all();
        $states = MiscListStates::where("tableParent", "=", 'stages')->get();
        return view('pages.stages.add', compact('disciplines', 'states'));
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
        if ($request->hasFile('photo')) {
            $datosToSend['photo'] = $request->file('photo')->store('uploads', 'public');
        }
        Stage::insert($datosToSend);
        //return response()->json($datosToSend);
        return redirect('/escenario')->with('mensaje', 'Escenario creado con ??xito.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Stage  $stage
     * @return \Illuminate\Http\Response
     */
    public function show($id/*Stage $stage*/)
    {
        //$stage = Stage::find($id);

        $stageDef = Stage::find($id);
        $states = MiscListStates::where("tableParent", "=", 'stages')->get();
        $stage = Stage::join('disciplines', 'disciplines.disciplineId', '=', 'stages.discipline')
            ->where('id', $stageDef->id)
            ->first();

        return view('pages.stages.guestStagesView', compact('stage', 'states'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Stage  $stage
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $disciplines = Disciplines::all();
        $stage = Stage::findOrFail($id);
        $states = MiscListStates::where("tableParent", "=", 'stages')->get();
        return view('pages.stages.edit', compact('stage', 'states'), compact('disciplines'));
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
        $datos = request()->except('_token', '_method');

        $datosToSend = new Stage();
        $datosToSend = $datos;
        //$datosToSend->created_at = Carbon::now()->toTimeString();
        //$datosToSend->updated_at = Carbon::now()->toTimeString();
        if ($request->hasFile('photo')) {
            $stage = Stage::findOrFail($id);
            Storage::delete('public/' . $stage->photo);
            $datosToSend['photo'] = $request->file('photo')->store('uploads', 'public');
        }
        Stage::where('id', '=', $id)->update($datosToSend);
        //return response()->json($datosToSend);
        return redirect('/escenario')->with('mensaje', 'Escenario editado con ??xito.');
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
        Storage::delete('public/' . $stage->photo);
        Stage::destroy($id);
        return redirect('/escenario')->with('mensaje', 'Escenario eliminado con ??xito.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Stage  $stage
     * @return \Illuminate\Http\Response
     */
    public function viewStageInfo($id/*Stage $stage*/)
    {
        //$stage = Stage::find($id);

        $arrStages = array();
        $arrResourceInfo = array();

        $stageDef = Stage::find($id);

        $stage = Stage::join('disciplines', 'disciplines.disciplineId', '=', 'stages.discipline')
            ->where('id', $stageDef->id)
            ->first();

        $understages = Stage::join('understages', 'understages.idStage', '=', 'stages.id')
            ->where('id', $stageDef->id)
            ->join('disciplines', 'disciplines.disciplineId', '=', 'understages.discipline_understg')
            ->get();

        $stageWarehouse = warehouse::where('warehouseLocation', $stageDef->id)->get();

        foreach ($stageWarehouse as $sw) {
            $stageComplete = Stage::join('warehouses', 'warehouses.warehouseLocation', '=', 'stages.id')
                ->join('resources', 'resources.resources_warehouseId', '=', 'warehouses.warehouseId')
                ->where('id', $stageDef->id)->where('warehouseId', $sw->warehouseId)
                ->join('misc_list_states', 'misc_list_states.statesId', '=', 'resources.id_category')->get();

            array_push($arrStages, $stageComplete);
        }

        return view('pages.stages.stageAdminView', compact('stage', 'understages', 'stageWarehouse', 'arrStages', 'arrResourceInfo'));
    }

    /**
     * Generar reporte general
     */
    public function pdfStageGeneral($id)
    {
        $stageDef = Stage::find($id);

        $stage = Stage::join('disciplines', 'disciplines.disciplineId', '=', 'stages.discipline')
            ->where('id', $stageDef->id)
            ->first();

        $understages = Stage::join('understages', 'understages.idStage', '=', 'stages.id')
            ->where('id', $stageDef->id)
            ->join('disciplines', 'disciplines.disciplineId', '=', 'understages.discipline_understg')
            ->get();

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

        $pdf->loadView('pages.reports.ReporteGenStage', compact('stage', 'understages'))->setOptions(['defaultFont' => 'sans-serif']);

        return $pdf->download($stage->name . '.pdf');
    }
}
