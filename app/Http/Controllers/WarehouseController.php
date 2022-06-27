<?php

namespace App\Http\Controllers;

use App\Models\warehouse;
use Illuminate\Http\Request;

class WarehouseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $warehouses['warehouses'] = warehouse::paginate(5);
        return view('pages.inventary.warehouse.admin', $warehouses);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $warehouse = warehouse::all();
        return view('pages.inventary.warehouse.add', compact('warehouse'));
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

        return redirect('/almacen')->with('mensaje','Almacén creada con éxito.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\warehouse  $warehouse
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $warehouse = warehouse::find($id);
        return view('pages.inventary.warehouse.show', compact('warehouse'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\warehouse  $warehouse
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $warehouse = warehouse::find($id);
        return view('pages.inventary.warehouse.edit', compact('warehouse'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\warehouse  $warehouse
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $datos = request()->except('_token','_method');

        $datosToSend = new warehouse();
        $datosToSend = $datos;  
        warehouse::where('id','=',$id)->update($datosToSend);
        return redirect('/almacen')->with('mensaje','Almacén editado con éxito.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\warehouse  $warehouse
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        warehouse::destroy($id);   
        return redirect('/almacen')->with('mensaje','Almacén eliminado con éxito.');
    }
}
