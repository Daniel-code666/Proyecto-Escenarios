<?php

namespace App\Http\Controllers;

use App\Models\Stage;
use App\Models\Disciplines;
use App\Models\MiscListStates;
use App\Models\Locality;
use App\Models\Neighborhood;
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
use App\Reports\MyReport;

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
        $localities = Locality::select("*")->orderBy('name', 'ASC')->get();
        $neighbordhoods = Neighborhood::select("*")->orderBy('name', 'ASC')->get();
        return view('pages.stages.add', compact('disciplines', 'states', 'localities', 'neighbordhoods'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate(
            [
                'id_category' => 'required',
                'message_state' => 'required | max:500',
                'discipline' => 'required',
                'name' => 'required | unique:Stages| max : 100',
                'area' => 'required | numeric',
                'address' => 'required',
                'capacity' => 'required | numeric',
                'descripcion' => 'required | max:500',
                'latitude' => 'required',
                'longitude' => 'required',
                'underStagesQty' => 'required',
                'stegeCode' => 'required',
                'localityid' => 'required',
                'neighborhoodsid' => 'required'
            ],
            [
                'id_category.required' => 'Este campo es requerido',
                'message_state.required' => 'Este campo es requerido',
                'discipline.required' => 'Este campo es requerido',
                'name.required' => 'Este campo es requerido',
                'area.required' => 'Este campo es requerido',
                'address.required' => 'Este campo es requerido',
                'capacity.required' => 'Este campo es requerido',
                'descripcion.required' => 'Este campo es requerido',
                'latitude.required' => 'Este campo es requerido',
                'longitude.required' => 'Este campo es requerido',
                'underStagesQty.required' => 'Este campo es requerido',
                'stegeCode.required' => 'Este campo es requerido',
                'localityid.required' => 'Este campo es requerido',
                'neighborhoodsid.required' => 'Este campo es requerido',
                'message_state.max' => 'El máximo de caracteres es 500',
                'descripcion.max' => 'El máximo de caracteres es 500',
                'area.numeric' => 'Debe ser un campo numérico',
                'capacity.numeric' => 'Debe ser un campo numérico',
                'name.unique' => 'Nombre ya registrado',
                'name.max' => 'El máximo de caracteres es 100',
            ]
        );

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
        return redirect('/escenario')->with('mensaje', 'Escenario creado con éxito.');
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
        $disciplines = Disciplines::all();
        $localities = Locality::select("*")->orderBy('name', 'ASC')->get();
        $neighbordhoods = Neighborhood::select("*")->orderBy('name', 'ASC')->get();

        return view('pages.stages.guestStagesView', compact('stage', 'states', 'disciplines', 'localities', 'neighbordhoods'));
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
        $localities = Locality::select("*")->orderBy('name', 'ASC')->get();
        $neighbordhoods = Neighborhood::select("*")->orderBy('name', 'ASC')->get();
        return view('pages.stages.edit', compact('stage', 'disciplines', 'states', 'localities', 'neighbordhoods'));
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
        $request->validate(
            [
                'id_category' => 'required',
                'message_state' => 'required | max:500',
                'discipline' => 'required',
                'name' => 'required | max:100',
                'area' => 'required | numeric',
                'address' => 'required',
                'capacity' => 'required | numeric',
                'descripcion' => 'required | max:500',
                'latitude' => 'required',
                'longitude' => 'required',
                'underStagesQty' => 'required',
                'stegeCode' => 'required',
                'localityid' => 'required',
                'neighborhoodsid' => 'required'
            ],
            [
                'id_category.required' => 'Este campo es requerido',
                'message_state.required' => 'Este campo es requerido',
                'discipline.required' => 'Este campo es requerido',
                'name.required' => 'Este campo es requerido',
                'area.required' => 'Este campo es requerido',
                'address.required' => 'Este campo es requerido',
                'capacity.required' => 'Este campo es requerido',
                'descripcion.required' => 'Este campo es requerido',
                'latitude.required' => 'Este campo es requerido',
                'longitude.required' => 'Este campo es requerido',
                'underStagesQty.required' => 'Este campo es requerido',
                'stegeCode.required' => 'Este campo es requerido',
                'localityid.required' => 'Este campo es requerido',
                'neighborhoodsid.required' => 'Este campo es requerido',
                'message_state.max' => 'El máximo de caracteres es 500',
                'descripcion.max' => 'El máximo de caracteres es 500',
                'area.numeric' => 'Debe ser un campo numérico',
                'capacity.numeric' => 'Debe ser un campo numérico',
                'name.max' => 'El máximo de caracteres es 100'
            ]
        );

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
        return redirect('/escenario')->with('mensaje', 'Escenario editado con éxito.');
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
        return redirect('/escenario')->with('mensaje', 'Escenario eliminado con éxito.');
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

        $stage = Stage::join('disciplines', 'disciplines.disciplineId', '=', 'stages.discipline')
            ->join('misc_list_states', 'misc_list_states.statesId', '=', 'stages.id_category')
            ->join('localities', 'localities.localityId', '=', 'stages.localityid')
            ->join('neighborhoods', 'neighborhoods.hoodId', '=', 'stages.neighborhoodid')
            ->where('id', $id)
            ->where('misc_list_states.tableParent', '=', 'stages')
            ->first();

        $understages = Stage::join('understages', 'understages.idStage', '=', 'stages.id')
            ->where('id', $id)
            ->join('disciplines', 'disciplines.disciplineId', '=', 'understages.discipline_understg')
            ->get();

        $stageWarehouse = warehouse::where('warehouseLocation', $id)
            ->where('warehouses.locationCheck', 1)->get();

        foreach ($stageWarehouse as $sw) {
            $stageComplete = Stage::join('warehouses', 'warehouses.warehouseLocation', '=', 'stages.id')
                ->join('resources', 'resources.resources_warehouseId', '=', 'warehouses.warehouseId')
                ->join('misc_list_states', 'misc_list_states.statesId', '=', 'resources.id_category')
                ->where('id', $id)->where('warehouseId', $sw->warehouseId)
                ->where('warehouses.locationCheck', 1)
                ->get();
            array_push($arrStages, $stageComplete);
        }

        return view('pages.stages.stageAdminView', compact('stage', 'understages', 'stageWarehouse', 'arrStages'));
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
