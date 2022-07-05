<?php

namespace App\Http\Controllers;

use App\Models\Resources;
use Illuminate\Http\Request;
use App\Models\Stage;
use App\Models\warehouse;
use App\Models\MiscListStates;

class ResourcesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $resources['resources'] = Resources::join('warehouses',
        'warehouses.warehouseId', '=', 'resources.resources_warehouseId')
        ->join('stages', 'stages.id', '=', 'warehouses.warehouseLocation')
        ->paginate(10);

        return view('pages.Inventary.items.admin', $resources);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $warehouses = warehouse::join('stages', 'stages.id', '=', 'warehouses.warehouseLocation')->paginate(1000);
        $states = MiscListStates::where("tableParent","=",'stages')->get();
        return view('pages.Inventary.items.add', compact('warehouses', 'states'));
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

        $tempObj = (object) $datos;

        if($tempObj->resourceCode == null){
            $tempObj->resourceCode = $tempObj->resourceName.$tempObj->resources_warehouseId;

            $datosToSend = new Resources();
            $datosToSend = (array) $tempObj;  

            if($request->hasFile('resourcePhoto')){
                $datosToSend['resourcePhoto']=$request->file('resourcePhoto')->store('uploads','public');
            }
            Resources::insert($datosToSend);
            return redirect('/item')->with('mensaje','Recurso creado con éxito.');
        }

        $datosToSend = new Resources();
        $datosToSend = $datos;  

        // $datosToSend->created_at = Resources::now()->toTimeString();
        // $datosToSend->updated_at = Resources::now()->toTimeString();
        if($request->hasFile('resourcePhoto')){
            $datosToSend['resourcePhoto']=$request->file('resourcePhoto')->store('uploads','public');
        }
        Resources::insert($datosToSend);
        //return response()->json($datosToSend);
        return redirect('/item')->with('mensaje','Recurso creado con éxito.');
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
        $stages = Stage::all();
        $resource = Resources::FindOrFail($idResource);
        return view('pages.Inventary.items.add', compact('stages', 'resource'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Resources  $resources
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Resources $resources)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Resources  $resources
     * @return \Illuminate\Http\Response
     */
    public function destroy(Resources $resources)
    {
        //
    }
}
