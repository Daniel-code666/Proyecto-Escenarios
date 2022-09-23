<?php

namespace App\Http\Controllers;

use App\Models\Resources;
use Illuminate\Http\Request;
use App\Models\Stage;
use App\Models\warehouse;
use App\Models\MiscListStates;
use App\Models\Resupply_records;
use Illuminate\Support\Facades\Storage;
use App\Reports\MyReport;
use App\Reports\MyReportPDF;
use App\Reports\ResourcesCard;
use PDF;
use Carbon\Carbon;

class ResourcesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $warehousesArr = array();

        $resources['resources'] = Resources::join(
            'warehouses',
            'warehouses.warehouseId',
            '=',
            'resources.resources_warehouseId'
        )
            ->join('misc_list_states', 'misc_list_states.statesId', '=', 'resources.id_category')
            ->join('stages', 'stages.id', '=', 'warehouses.warehouseLocation')
            ->where('warehouses.locationCheck', 1)
            ->where('misc_list_states.tableParent', 'inventary')
            ->get();

        $resourcesSub['resourcesSub'] = Resources::join(
            'warehouses',
            'warehouses.warehouseId',
            '=',
            'resources.resources_warehouseId'
        )
            ->join('misc_list_states', 'misc_list_states.statesId', '=', 'resources.id_category')
            ->join('understages', 'understages.idUnderstage', '=', 'warehouses.warehouseLocation')
            ->where('locationCheck', 0)
            ->where('misc_list_states.tableParent', 'inventary')
            ->get();

        $warehouses['warehouses'] = warehouse::join('stages', 'stages.id', '=', 'warehouses.warehouseLocation')
            ->where('locationCheck', 1)
            ->get();

        $warehousesSub['warehousesSub'] = warehouse::join('understages', 'understages.idUnderstage', '=', 'warehouses.warehouseLocation')
            ->where('locationCheck', 0)
            ->get();

        array_push($warehousesArr, $warehouses);
        array_push($warehousesArr, $warehousesSub);

        $report = new ResourcesCard;
        $report->run();

        return view('pages.Inventary.items.admin', compact('resources', 'resourcesSub', 'warehouses', 'warehousesArr', 'report'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $warehouses = warehouse::join('stages', 'stages.id', '=', 'warehouses.warehouseLocation')
            ->where('locationCheck', 1)
            ->get();
        $warehousesSub = warehouse::join('understages', 'understages.idUnderstage', '=', 'warehouses.warehouseLocation')
            ->where('locationCheck', 0)
            ->get();
        $states = MiscListStates::where("tableParent", "=", 'inventary')->get();
        return view('pages.Inventary.items.add', compact('warehouses', 'states', 'warehousesSub'));
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
                'resourceName' => 'required | max:100',
                'resourceMsgState' => 'required | max:500',
                'resourceDescription' => 'required | max:500',
                'resourceCode' => 'required | max:50 | unique:resources',
                'amount' => 'required | numeric',
            ],
            [
                'resourceName.required' => 'Este campo es requerido',
                'resourceMsgState.required' => 'Este campo es requerido',
                'resourceDescription.required' => 'Este campo es requerido',
                'resourceCode.required' => 'Este campo es requerido',
                'amount.required' => 'Este campo es requerido',
                'resourceName.max' => 'El máximo de caracteres es 100',
                'resourceMsgState.max' => 'El máximo de caracteres es 500',
                'resourceMsgState.max' => 'El máximo de caracteres es 500',
                'resourceCode.max' => 'El máximo de caracteres es 50',
                'amount.numeric' => 'Debe ser un campo numérico',
                'resourceCode.unique' => 'Código ya utillizado',
            ]
        );

        $datos = request()->except('_token');

        $tempObj = (object) $datos;

        if ($tempObj->resourceCode == null) {
            $tempObj->resourceCode = $tempObj->resourceName . $tempObj->resources_warehouseId;
        }

        if ($tempObj->amountInUse == null) {
            $tempObj->amountInUse = 0;
        }

        $datosToSend = new Resources();
        $datosToSend = (array) $tempObj;

        // $datosToSend->created_at = Resources::now()->toTimeString();
        // $datosToSend->updated_at = Resources::now()->toTimeString();
        if ($request->hasFile('resourcePhoto')) {
            $datosToSend['resourcePhoto'] = $request->file('resourcePhoto')->store('uploads', 'public');
        }
        Resources::insert($datosToSend);
        //return response()->json($datosToSend);
        return redirect('/item')->with('mensaje', 'Recurso creado con éxito.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Resources  $resources
     * @return \Illuminate\Http\Response
     */
    public function show(Resources $resources)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Resources  $resources
     * @return \Illuminate\Http\Response
     */
    public function edit($idResource)
    {
        $warehouses = warehouse::join('stages', 'stages.id', '=', 'warehouses.warehouseLocation')
            ->where('locationCheck', 1)
            ->get();
        $warehousesSub = warehouse::join('understages', 'understages.idUnderstage', '=', 'warehouses.warehouseLocation')
            ->where('locationCheck', 0)
            ->get();
        $states = MiscListStates::where("tableParent", "=", 'inventary')->get();
        $resource = Resources::FindOrFail($idResource);
        return view('pages.Inventary.items.edit', compact('warehouses', 'warehousesSub', 'states', 'resource'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Resources  $resources
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $idResource)
    {
        $request->validate(
            [
                'resourceName' => 'required | max:100',
                'resourceMsgState' => 'required | max:500',
                'resourceDescription' => 'required | max:500',
                'resourceCode' => 'required | max:50',
                'amount' => 'required | numeric'
            ],
            [
                'resourceName.required' => 'Este campo es requerido',
                'resourceMsgState.required' => 'Este campo es requerido',
                'resourceDescription.required' => 'Este campo es requerido',
                'resourceCode.required' => 'Este campo es requerido',
                'amount.required' => 'Este campo es requerido',
                'resourceName.max' => 'El máximo de caracteres es 100',
                'resourceMsgState.max' => 'El máximo de caracteres es 500',
                'resourceMsgState.max' => 'El máximo de caracteres es 500',
                'resourceCode.max' => 'El máximo de caracteres es 50',
                'amount.numeric' => 'Debe ser un campo numérico'
            ]
        );

        $data = request()->except('_token', '_method');

        $tempObj = (object) $data;

        if ($tempObj->resourceCode == null) {
            $tempObj->resourceCode = $tempObj->resourceName . $tempObj->resources_warehouseId;
        }

        if ($tempObj->amountInUse == null) {
            $tempObj->amountInUse = 0;
        }

        $dataToSend = new Resources();
        $dataToSend = (array) $tempObj;

        if ($request->hasFile('resourcePhoto')) {
            $resource = Resources::findOrFail($idResource);
            Storage::delete('public/' . $resource->resourcePhoto);
            $dataToSend['resourcePhoto'] = $request->file('resourcePhoto')->store('uploads', 'public');
        }

        Resources::where('idResource', '=', $idResource)->update($dataToSend);

        return redirect('/item')->with('mensaje', 'Recurso actualizado con éxito.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Resources  $resources
     * @return \Illuminate\Http\Response
     */
    public function destroy($idResource)
    {
        Resources::destroy($idResource);
        return redirect('/item')->with('mensaje', 'Recurso eliminado con éxito.');
    }

    /**
     * trae la información del objeto para establecer la cantidad en uso del inventario
     */
    public function bringResourceInfo($idResource)
    {
        $resource = Resources::FindOrFail($idResource);
        return view('pages.Inventary.items.assign', compact('resource'));
    }


    /**
     * Asigna la cantidad en uso de un elemento en el inventario
     */

    public function setInUseItem(Request $request, $idResource)
    {

        $request->validate(
            [
                'amountInUse' => 'required | numeric'
            ],
            [
                'amountInUse.required' => 'Este campo es requerido'
            ]
        );

        $resource = Resources::find($idResource);

        $data = request()->except('_token', '_method');

        foreach ($data as $d) {
            $amountInUse = (int) $d;
        }

        if ($amountInUse > $resource->amount) {
            return redirect('/item')->with('mensaje', 'La cantidad asignada excede la cantidad en el almacén');
        }

        if ($amountInUse == 0) {
            $newAmount = $resource->amount + $amountInUse;
            $newAmountInUse = $resource->amountInUse + $amountInUse;
            Resources::where('idResource', $resource->idResource)->update(["amount" => $newAmount, "amountInUse" => $newAmountInUse]);

            return redirect('/item')->with('mensaje', 'Se ha asignado la cantidad correctamente');
        }

        $newAmount = $resource->amount - $amountInUse;
        $newAmountInUse = $resource->amountInUse + $amountInUse;
        Resources::where('idResource', $resource->idResource)->update(["amount" => $newAmount, "amountInUse" => $newAmountInUse]);

        return redirect('/item')->with('mensaje', 'Se ha asignado la cantidad correctamente');
    }

    /**
     * Devuelve los recursos en USO al ALMACÉN
     */
    public function setBackWarehouse(Request $request, $idResource)
    {
        $resource = Resources::find($idResource);

        $data = request()->except('_token', '_method');

        foreach ($data as $d) {
            $amountReturned = (int) $d;
        }

        if ($amountReturned > $resource->amountInUse) {
            return redirect('/item')->with('mensaje', 'La cantidad devuelta excede a la cantidad en uso');
        }

        if ($amountReturned == 0) {
            $newAmountInUse = $resource->amountInUse - $amountReturned;
            $newAmount = $resource->amount + $amountReturned;
            Resources::where('idResource', $resource->idResource)->update(["amount" => $newAmount, "amountInUse" => $newAmountInUse]);

            return redirect('/item')->with('mensaje', 'Se ha asignado la cantidad correctamente');
        }

        $newAmount = $resource->amount + $amountReturned;
        $newAmountInUse = $resource->amountInUse - $amountReturned;
        Resources::where('idResource', $resource->idResource)->update(["amount" => $newAmount, "amountInUse" => $newAmountInUse]);

        return redirect('/item')->with('mensaje', 'Se ha asignado la cantidad correctamente');
    }

    /**
     * Trae la información del elemento para asignar la cantidad a reabastecer
     */
    public function bringResourceToResupply($idResource)
    {
        $resource = Resources::FindOrFail($idResource);
        $resupply = Resupply_records::where('idResourceFk', $idResource)->latest('updated_at')->first();

        // $cont = 0;

        // if ($resupply->isEmpty()) {
        //     Resupply_record::insert([
        //         'idResourceFk' => $resource->idResource, 'resupplyAmount' => 0,
        //         'created_at' => Carbon::now()
        //     ]);
        //     $resupply = Resupply_record::where('idResourceFk', $idResource);
        //     return view('pages.Inventary.items.assign', compact('resource', 'resupply'));
        // } else {
        //     return view('pages.Inventary.items.assign', compact('resource', 'resupply'));
        // }
        return view('pages.Inventary.items.resupplyAssign', compact('resource', 'resupply'));
    }

    /**
     * Asigna la cantidad de elementos reabastecida
     */
    public function setResupply(Request $request, $idResource)
    {
        $resource = Resources::find($idResource);

        $data = request()->except('_token', '_method');

        foreach ($data as $d) {
            $resupplyAmount = (int) $d;
        }

        $newAmount = $resource->amount + $resupplyAmount;

        // Resupply_record::where('idResourceFk', $resource->idResource)
        //     ->update(["resupplyAmount" => $resupplyAmount, "created_at" => Carbon::now(), "updated_at" => Carbon::now()]);

        Resupply_records::insert([
            'idResourceFk' => $resource->idResource, 'resupplyAmount' => $resupplyAmount,
            'created_at' => Carbon::now(), 'updated_at' => Carbon::now()
        ]);

        Resources::where('idResource', $resource->idResource)
            ->update(["amount" => $newAmount, "updated_at_resources" => Carbon::now()]);

        return redirect('/item')->with('mensaje', 'El recurso ha sido reabastecido');
    }

    // public function testPDF($id){
    //     $this->reportPDF($id);

    //     $pdf = app('dompdf.wrapper');
    //     $contxt = stream_context_create([
    //         'ssl' => [
    //             'verify_peer' => FALSE,
    //             'verify_peer_name' => FALSE,
    //             'allow_self_signed' => TRUE,
    //         ]
    //     ]);

    //     $pdf = PDF::setOptions(['isHTML5ParserEnabled' => true, 'isRemoteEnabled' => true]);
    //     $pdf->getDomPDF()->setHttpContext($contxt);

    //     $pdf->loadView('reports.reportPDF')->setOptions(['defaultFont' => 'sans-serif']);

    //     return $pdf->download('inventarios.pdf');
    // }

    public function inventoryQuantityReport($id)
    {
        $report = new MyReport(array("id" => $id));
        $report->run();
        return view("reports.report", ["report" => $report]);
    }

    public function reportPDF($id)
    {
        $report = new MyReportPDF(array("id" => $id));
        $report->run();
        return view("reports.reportPDF", ["report" => $report]);
    }
}
