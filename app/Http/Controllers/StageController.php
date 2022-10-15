<?php

namespace App\Http\Controllers;

use App\Models\Stage;
use App\Models\Disciplines;
use App\Models\MiscListStates;
use App\Models\Locality;
use App\Models\neighborhood;
use App\Models\Resources;
use App\Models\stage_deleted_records;
use App\Models\stage_updated_records;
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
use Ramsey\Uuid\Type\Decimal;

class StageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $stages['stages'] = Stage::join('disciplines', 'disciplines.disciplineId', '=', 'stages.discipline')
            ->join('misc_list_states', 'misc_list_states.statesId', '=', 'stages.id_category')
            ->join('localities', 'localities.localityid', '=', 'stages.localityid')
            ->join('neighborhoods', 'neighborhoods.hoodId', '=', 'stages.neighborhoodid')
            ->where('misc_list_states.tableParent', 'stages')->get();
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
        $localities = Locality::select("*")->orderBy('localityName', 'ASC')->get();
        $neighbordhoods = neighborhood::select("*")->orderBy('hoodName', 'ASC')->get();
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
                'name' => 'required | unique:stages| max : 100',
                'area' => 'required | numeric',
                'address' => 'required',
                'capacity' => 'required | numeric',
                'descripcion' => 'required | max:500',
                'latitude' => 'required',
                'longitude' => 'required',
                'underStagesQty' => 'required',
                'stegeCode' => 'required',
                'localityid' => 'required',
                'neighborhoodid' => 'required'
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
                'neighborhoodid.required' => 'Este campo es requerido',
                'message_state.max' => 'El máximo de caracteres es 500',
                'descripcion.max' => 'El máximo de caracteres es 500',
                'area.numeric' => 'Debe ser un campo numérico',
                'capacity.numeric' => 'Debe ser un campo numérico',
                'name.unique' => 'Nombre ya registrado',
                'name.max' => 'El máximo de caracteres es 100',
            ]
        );

        $datos = request()->except('_token');

        $datosToSend = new Stage();
        $datosToSend->created_at = Carbon::now()->toTimeString();
        $datosToSend->updated_at = Carbon::now()->toTimeString();
        $datosToSend = $datos;
        if ($request->hasFile('photo')) {
            $datosToSend['photo'] = $request->file('photo')->store('uploads', 'public');
        }
        $datosToSend['score'] = 5;
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

        if ($stageDef == null) {
            $stages['stages'] = Stage::join('disciplines', 'disciplines.disciplineId', '=', 'stages.discipline')
                ->paginate(10);

            return view('pages.stages.listStages', $stages);
        }


        $states = MiscListStates::where("tableParent", "=", 'stages')->get();
        $stage = Stage::join('disciplines', 'disciplines.disciplineId', '=', 'stages.discipline')
            ->where('id', $stageDef->id)
            ->first();
        $disciplines = Disciplines::all();
        $localities = Locality::select("*")->orderBy('localityName', 'ASC')->get();
        $neighbordhoods = neighborhood::select("*")->orderBy('hoodName', 'ASC')->get();
        $subStages = Understage::where("idStage", $id)->get();

        switch ($id) {
            case 1:
                return view('pages.stages.views.stageone', compact('stage', 'states', 'disciplines', 'localities', 'neighbordhoods'));
                break;
            case 2:
                return view('pages.stages.views.stagetwo', compact('stage', 'states', 'disciplines', 'localities', 'neighbordhoods'));
                break;
            case 3:
                return view('pages.stages.views.stagethree', compact('stage', 'states', 'disciplines', 'localities', 'neighbordhoods', 'subStages'));
                break;
            case 4:
                return view('pages.stages.views.stagefour', compact('stage', 'states', 'disciplines', 'localities', 'neighbordhoods'));
                break;
            case 5:
                return view('pages.stages.views.stagefive', compact('stage', 'states', 'disciplines', 'localities', 'neighbordhoods'));
                break;
            case 6:
                return view('pages.stages.views.stagesix', compact('stage', 'states', 'disciplines', 'localities', 'neighbordhoods'));
                break;
            case 7:
                return view('pages.stages.views.stageseven', compact('stage', 'states', 'disciplines', 'localities', 'neighbordhoods', 'subStages'));
                break;
            default:
                return view('pages.stages.guestStagesView', compact('stage', 'states', 'disciplines', 'localities', 'neighbordhoods'));
                break;
        }
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
        $localities = Locality::select("*")->orderBy('localityName', 'ASC')->get();
        $neighbordhoods = neighborhood::select("*")->orderBy('hoodName', 'ASC')->get();
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
                'neighborhoodid' => 'required'
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
                'neighborhoodid.required' => 'Este campo es requerido',
                'message_state.max' => 'El máximo de caracteres es 500',
                'descripcion.max' => 'El máximo de caracteres es 500',
                'area.numeric' => 'Debe ser un campo numérico',
                'capacity.numeric' => 'Debe ser un campo numérico',
                'name.max' => 'El máximo de caracteres es 100'
            ]
        );

        $datos = request()->except('_token', '_method');

        $datosToSend = new Stage();
        $datosToSend->created_at = Carbon::now()->toTimeString();
        $datosToSend->updated_at = Carbon::now()->toTimeString();
        $datosToSend = $datos;

        $stage = Stage::findOrFail($id);

        if ($request->hasFile('photo')) {
            Storage::delete('public/' . $stage->photo);
            $datosToSend['photo'] = $request->file('photo')->store('uploads', 'public');
        }

        Stage::where('id', '=', $id)->update($datosToSend);

        stage_updated_records::insert(
            [
                'name' => $stage->name, 'area' => $stage->area, 'capacity' => $stage->capacity,
                'address' => $stage->address, 'underStageQty' => $stage->underStagesQty,
                'stegeCode' => $stage->stegeCode, 'locality_updt' => $stage->localityid,
                'neighborhood_updt' => $stage->neighborhoodid, 'updt_at' => Carbon::now(),
                'userEmail' => session()->get('userEmail')
            ]
        );
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
        $mainWarehouses = warehouse::where('warehouseLocation', $id)
            ->where('locationCheck', 1)->get();

        $underStage = Understage::where('idStage', $id)->get();

        foreach ($mainWarehouses as $mainWarehouse) {
            Resources::where('resources_warehouseId', $mainWarehouse->warehouseId)->delete();
        }

        warehouse::where('warehouseLocation', $id)
            ->where('locationCheck', 1)
            ->delete();

        foreach ($underStage as $underStage) {
            $warehouses = warehouse::where('warehouseLocation', $underStage->idUnderstage)->get();
            foreach ($warehouses as $warehouse) {
                Resources::where('resources_warehouseId', $warehouse->warehouseId)->delete();
            }
            warehouse::where('warehouseLocation', $underStage->idUnderstage)
                ->where('locationCheck', 0)
                ->delete();
        }

        Understage::where('idStage', $id)->delete();

        Storage::delete('public/' . $stage->photo);
        Stage::destroy($id);

        stage_deleted_records::insert(
            [
                'name' => $stage->name, 'area' => $stage->area, 'capacity' => $stage->capacity,
                'address' => $stage->address, 'underStageQty' => $stage->underStagesQty,
                'stegeCode' => $stage->stegeCode, 'locality' => $stage->localityid,
                'neighborhood' => $stage->neighborhoodid, 'deleted_at' => Carbon::now(-1),
                'userEmail' => session()->get('userEmail')
            ]
        );
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

    public function updateScore(Request $request, $id)
    {
        $datos = request()->except('_token', '_method');
        $curStage = Stage::find($id);
        if ($curStage->score == null)
            $curStage->score = 5;
        $score = $datos['score'];
        $avrScore = (float)($curStage->score + $score) / 2;
        Stage::where('id', $id)->update(['score' => $avrScore]);
        return redirect('/show/' . $id)
            ->with('score', $score)
            ->with('mensaje', 'Calificación enviada.');
    }

    public function mapaescenarios()
    {
        $stages = Stage::all();
        return view('layouts.appMaps', $stages)->with('stages', $stages);
    }
}
