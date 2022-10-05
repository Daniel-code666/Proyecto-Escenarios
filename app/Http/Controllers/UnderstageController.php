<?php

namespace App\Http\Controllers;

use App\Models\Understage;
use Illuminate\Http\Request;
use App\Models\Disciplines;
use App\Models\Stage;
use Illuminate\Support\Facades\Storage;
use App\Models\MiscListStates;
use App\Models\Resources;
use App\Models\warehouse;
use Carbon\Carbon;
use PDF;
use App\Models\Locality;
use App\Models\Neighborhood;

class UnderstageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $underStages['underStages'] = Understage::join('disciplines', 'disciplines.disciplineId', '=', 'understages.discipline_understg')
            ->join('misc_list_states', 'misc_list_states.statesId', '=', 'understages.id_category_understg')
            ->join('stages', 'stages.id', '=', 'understages.idStage')
            ->where('misc_list_states.tableParent', 'stages')->get();

        $stages['stages'] = Stage::join('disciplines', 'disciplines.disciplineId', '=', 'stages.discipline')
            ->join('misc_list_states', 'misc_list_states.statesId', '=', 'stages.id_category')
            ->join('localities', 'localities.localityid', '=', 'stages.localityid')
            ->join('neighborhoods', 'neighborhoods.hoodId', '=', 'stages.neighborhoodid')
            ->where('misc_list_states.tableParent', 'stages')->get();

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
        $localities = Locality::select("*")->orderBy('localityName', 'ASC')->get();
        $neighbordhoods = Neighborhood::select("*")->orderBy('hoodName', 'ASC')->get();
        return view('pages.Understages.underStCreate', compact('disciplines', 'stages', 'states', 'localities', 'neighbordhoods'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $request->validate(
        //     [
        //         'message_state_understg' => 'required | max:500',
        //         'capacity_understg' => 'required | numeric',
        //         'name_understg' => 'required | max:100',
        //         'area_understg' => 'required | numeric',
        //         'address_understg' => 'required ',
        //         'latitude_understg' => 'required',
        //         'longitude_understg' => 'required',
        //         'descripcion_understg' => 'required | max:500',
        //     ],
        //     [
        //         'message_state_understg.required' => 'Este campo es requerido',
        //         'capacity_understg.required' => 'Este campo es requerido',
        //         'name_understg.required' => 'Este campo es requerido',
        //         'area_understg.required' => 'Este campo es requerido',
        //         'address_understg.required' => 'Este campo es requerido',
        //         'latitude_understg.required' => 'Este campo es requerido',
        //         'longitude_understg.required' => 'Este campo es requerido',
        //         'descripcion_understg.required' => 'Este campo es requerido',
        //         'message_state_understg.max' => 'El máximo de caracteres es 500',
        //         'name_understg.max' => 'El máximo de caracteres es 100',
        //         'capacity_understg.numeric' => 'Debe ser un campo numérico',
        //         'area_understg.numeric' => 'Debe ser un campo numérico',
        //         'descripcion_understg.max' => 'El máximo de caracteres es 500',
        //     ]
        // );

        $datos = request()->except('_token');
        $datosToSend = new Understage();
        $datosToSend->created_at = Carbon::now()->toTimeString();
        $datosToSend->updated_at = Carbon::now()->toTimeString();
        $datosToSend = $datos;

        if ($request->hasFile('photo_understg')) {
            $datosToSend['photo_understg'] = $request->file('photo_understg')->store('uploads', 'public');
        }

        $stage = Stage::where('id', $datos['idStage'])->first();
        $newUnderStgQty = $stage->underStagesQty + 1;

        Understage::insert($datosToSend);
        Stage::where('id', '=', $datos['idStage'])->update(['underStagesQty' => $newUnderStgQty]);
        //return response()->json($datosToSend);
        return redirect('/understage')->with('mensaje', 'Sub escenario creado con éxito.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Understage  $understage
     * @return \Illuminate\Http\Response
     */
    public function show($idUnderstage)
    {
        $arrStages = array();

        $underStageDef = Understage::find($idUnderstage);

        $stage = Understage::join('disciplines', 'disciplines.disciplineId', '=', 'understages.discipline_understg')
            ->join('stages', 'stages.id', '=', 'understages.idStage')
            ->join('misc_list_states', 'misc_list_states.statesId', '=', 'understages.id_category_understg')
            ->where('idUnderstage', $underStageDef->idUnderstage)
            ->where('misc_list_states.tableParent', '=', 'stages')
            ->first();

        $stageMain = Stage::join('disciplines', 'disciplines.disciplineId', '=', 'stages.discipline')
            ->where('id', $stage->idStage)
            ->first();

        $stageWarehouse = warehouse::where('warehouseLocation', $underStageDef->idUnderstage)
            ->where('locationCheck', 0)->get();

        foreach ($stageWarehouse as $sw) {
            $stageComplete = Understage::join('warehouses', 'warehouses.warehouseLocation', '=', 'understages.idUnderstage')
                ->join('resources', 'resources.resources_warehouseId', '=', 'warehouses.warehouseId')
                ->join('misc_list_states', 'misc_list_states.statesId', '=', 'resources.id_category')
                ->where('idUnderstage', $underStageDef->idUnderstage)->where('warehouseId', $sw->warehouseId)
                ->where('warehouses.locationCheck', 0)
                ->get();
            array_push($arrStages, $stageComplete);
        }

        return view('pages.Understages.underStView', compact('stage', 'stageMain', 'stageWarehouse', 'arrStages'));
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
        $localities = Locality::select("*")->orderBy('localityName', 'ASC')->get();
        $neighbordhoods = Neighborhood::select("*")->orderBy('hoodName', 'ASC')->get();
        return view('pages.Understages.underStEdit', compact('underStage', 'disciplines', 'stages', 'states', 'localities', 'neighbordhoods'));
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
        $request->validate(
            [
                'message_state_understg' => 'required | max:500',
                'capacity_understg' => 'required | numeric',
                'name_understg' => 'required | max:100',
                'area_understg' => 'required | numeric',
                'address_understg' => 'required ',
                'latitude_understg' => 'required',
                'longitude_understg' => 'required',
                'description_understg' => 'required | max:500'
            ],
            [
                'message_state_understg.required' => 'Este campo es requerido',
                'capacity_understg.required' => 'Este campo es requerido',
                'name_understg.required' => 'Este campo es requerido',
                'area_understg.required' => 'Este campo es requerido',
                'address_understg.required' => 'Este campo es requerido',
                'latitude_understg.required' => 'Este campo es requerido',
                'longitude_understg.required' => 'Este campo es requerido',
                'description_understg.required' => 'Este campo es requerido',
                'message_state_understg.max' => 'El máximo de caracteres es 500',
                'name_understg.max' => 'El máximo de caracteres es 100',
                'capacity_understg.numeric' => 'Debe ser un campo numérico',
                'area_understg.numeric' => 'Debe ser un campo numérico',
                'description_understg.max' => 'El máximo de caracteres es 500'
            ]
        );

        $data = request()->except('_token', '_method');

        $dataToSend = new Understage();
        $dataToSend = $data;
        //$datosToSend->created_at = Carbon::now()->toTimeString();
        //$datosToSend->updated_at = Carbon::now()->toTimeString();
        if ($request->hasFile('photo_understg')) {
            $underStage = Understage::findOrFail($idUnderstage);
            Storage::delete('public/' . $underStage->photo_understg);
            $dataToSend['photo_understg'] = $request->file('photo_understg')->store('uploads', 'public');
        }
        Understage::where('idUnderstage', '=', $idUnderstage)->update($dataToSend);
        //return response()->json($datosToSend);
        return redirect('/understage')->with('mensaje', 'Escenario editado con éxito.');
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
        $stage = Stage::where('id', $underStage->idStage)->first();
        $newUnderStgQty = $stage->underStagesQty - 1;
        $warehouses = warehouse::where('warehouseLocation', $idUnderstage)
            ->where('locationCheck', 0)
            ->get();

        foreach ($warehouses as $warehouse){
            Resources::where('resources_warehouseId', $warehouse->warehouseId);
        }

        $warehouses = warehouse::where('warehouseLocation', $idUnderstage)
            ->where('locationCheck', 0)
            ->delete();

        Stage::where('id', $stage->id)->update(['underStagesQty' => $newUnderStgQty]);
        Storage::delete('public/' . $underStage->photo_understg);
        Understage::destroy($idUnderstage);

        return redirect('/understage')->with('mensaje', 'Escenario eliminado con éxito.');
    }

    public function listUnderSt($id)
    {
        $disciplines = Disciplines::all();
        $stages = Stage::findOrFail($id);
        $underStage = Understage::where('idStage', $id)->get();
        $states = MiscListStates::where("tableParent", "=", 'stages')->get();
        return view('pages.Understages.listUnderSt', compact('underStage', 'disciplines', 'stages', 'states'));
    }

    /**
     * Generar reporte general
     */
    public function pdfUnderstageGeneral($idUnderstage)
    {
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

        return $pdf->download($stage->name . '.pdf');
    }
}
