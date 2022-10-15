<?php

namespace App\Http\Controllers;

use App\Models\Resources;
use App\Models\warehouse;
use Illuminate\Http\Request;
use App\Models\Stage;
use App\Models\Understage;

class WarehouseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $warehouses['warehouses'] = warehouse::paginate(5);
        $warehouses['warehouses'] = warehouse::join('stages', 'stages.id', '=', 'warehouses.warehouseLocation')
            ->where('locationCheck', 1)
            ->get();

        $warehousesSub['warehousesSub'] = warehouse::join('understages', 'understages.idUnderstage', '=', 'warehouses.warehouseLocation')
            ->where('locationCheck', 0)
            ->get();

        $stages['stages'] = Stage::join('disciplines', 'disciplines.disciplineId', '=', 'stages.discipline')->get();

        $underStages['underStages'] = Understage::join('disciplines', 
        'disciplines.disciplineId', '=', 'understages.discipline_understg')
        ->join('stages', 'stages.id', '=', 'understages.idStage')->get();

        return view('pages.Inventary.warehouse.admin', compact('warehouses', 'stages', 'warehousesSub', 'underStages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $stages = Stage::all();
        $underStages = Understage::all();
        return view('pages.inventary.warehouse.add', compact('stages', 'underStages'));
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
                'warehouseName' => 'required | max:100 |unique:warehouses',
                'warehouseDescription' => 'required | max:500'
            ],
            [
                'warehouseName.required' => 'Este campo es requerido',
                'warehouseDescription.required' => 'Este campo es requerido',
                'warehouseName.max' => 'El máximo de caracteres es 100',
                'warehouseDescription.max' => 'El máximo de caracteres es 500',
                'warehouseName.unique' => 'Nombre ya utilizado'
            ]
        );

        $data = request()->except('_token');
        $dataToSend = new warehouse();
        $dataToSend = $data;

        warehouse::insert($dataToSend);

        return redirect('/almacen')->with('mensaje', 'Almacén creado con éxito.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\warehouse  $warehouse
     * @return \Illuminate\Http\Response
     */
    public function show($warehouseId)
    {
        $warehouse = warehouse::find($warehouseId);
        return view('pages.inventary.warehouse.show', compact('warehouse'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\warehouse  $warehouse
     * @return \Illuminate\Http\Response
     */
    public function edit($warehouseId)
    {
        $warehouse = warehouse::find($warehouseId);
        $stages = Stage::all();
        $underStages = Understage::all();
        return view('pages.inventary.warehouse.edit', compact('warehouse', 'stages', 'underStages'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\warehouse  $warehouse
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $warehouseId)
    {
        $request->validate(
            [
                'warehouseName' => 'required | max:100',
                'warehouseDescription' => 'required | max:500'
            ],
            [
                'warehouseName.required' => 'Este campo es requerido',
                'warehouseDescription.required' => 'Este campo es requerido',
                'warehouseName.max' => 'El máximo de caracteres es 100',
                'warehouseDescription.max' => 'El máximo de caracteres es 500'
            ]
        );

        $datos = request()->except('_token', '_method');

        $datosToSend = new warehouse();
        $datosToSend = $datos;
        warehouse::where('warehouseId', '=', $warehouseId)->update($datosToSend);
        return redirect('/almacen')->with('mensaje', 'Almacén editado con éxito.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\warehouse  $warehouse
     * @return \Illuminate\Http\Response
     */
    public function destroy($warehouseId)
    {
        Resources::where('resources_warehouseId', $warehouseId)->delete();
        warehouse::destroy($warehouseId);
        return redirect('/almacen')->with('mensaje', 'Almacén eliminado con éxito.');
    }
}
