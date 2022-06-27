<?php

namespace App\Http\Controllers;

use App\Models\warehouse;
use Illuminate\Http\Request;
use App\Models\Stage;

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
        $warehouses['warehouses'] = warehouse::join('stages', 
        'stages.id', '=', 'warehouses.warehouseLocation')->paginate(10);

        return view('pages.inventary.warehouse.admin', $warehouses);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $stages = Stage::all();
        return view('pages.inventary.warehouse.add', compact('stages'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = request()->except('_token');
        $dataToSend = new warehouse();
        $dataToSend = $data;

        warehouse::insert($dataToSend);

        return redirect('/almacen')->with('mensaje','Almacén creado con éxito.');
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
        return view('pages.inventary.warehouse.edit', compact('warehouse', 'stages'));
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
        $datos = request()->except('_token','_method');

        $datosToSend = new warehouse();
        $datosToSend = $datos;  
        warehouse::where('warehouseId','=', $warehouseId)->update($datosToSend);
        return redirect('/almacen')->with('mensaje','Almacén editado con éxito.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\warehouse  $warehouse
     * @return \Illuminate\Http\Response
     */
    public function destroy($warehouseId)
    {
        warehouse::destroy($warehouseId);   
        return redirect('/almacen')->with('mensaje','Almacén eliminado con éxito.');
    }
}
