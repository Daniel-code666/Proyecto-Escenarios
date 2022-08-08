<?php

namespace App\Http\Controllers;

use App\Models\MiscListStates;
use Illuminate\Http\Request;
use Carbon\Carbon;

class MiscListStatesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $misclist['misclist'] = MiscListStates::where("tableParent","=",'stages')->paginate(10);  
        return view('pages.misclist.admin', $misclist);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $states = MiscListStates::all();
        return view('pages.misclist.add', compact('states'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'statesName'=>'required | max:100',
            'statesDescription'=>'required | max:500'
        ],
        [
            'statesName.required' => 'Este campo es requerido',
            'statesDescription.required' => 'Este campo es requerido',     
            'statesName.max' => 'El máximo de caracteres es 100',
            'statesDescription.max' => 'El máximo de caracteres es 500'
        ]
        );

        $data = request()->except('_token');
        $dataToSend = new MiscListStates();
        $dataToSend = $data;
        $dataToSend['tableParent'] = 'stages';

        MiscListStates::insert($dataToSend);

        return redirect('/states')->with('mensaje','Estado creada con éxito.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\MiscListStates  $miscListStates
     * @return \Illuminate\Http\Response
     */
    public function show($statesId)
    {
        $stateescenary = MiscListStates::find($statesId);
        return view('pages.misclist.show', compact('stateescenary'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MiscListStates  $miscListStates
     * @return \Illuminate\Http\Response
     */
    public function edit($statesId)
    {
        $stateescenary = MiscListStates::find($statesId);
        return view('pages.misclist.edit', compact('stateescenary'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\MiscListStates  $miscListStates
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $statesId)
    {
        $request->validate([
            'statesName'=>'required | max:100',
            'statesDescription'=>'required | max:500'
        ],
        [
            'statesName.required' => 'Este campo es requerido',
            'statesDescription.required' => 'Este campo es requerido',     
            'statesName.max' => 'El máximo de caracteres es 100',
            'statesDescription.max' => 'El máximo de caracteres es 500'
        ]
        );
        $datos = request()->except('_token','_method');

        $datosToSend = new MiscListStates();
        $datosToSend = $datos;  
/*         $datosToSend['created_at'] = Carbon::now()->toTimeString();
        $datosToSend['updated_at'] = Carbon::now()->toTimeString(); */
        MiscListStates::where('statesId','=',$statesId)->update($datosToSend);
        return redirect('/states')->with('mensaje','Estado editado con éxito.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MiscListStates  $miscListStates
     * @return \Illuminate\Http\Response
     */
    public function destroy($statesId)
    {
        $state = MiscListStates::findOrFail($statesId);
        MiscListStates::destroy($statesId);   
        return redirect('/states')->with('mensaje','Estado eliminado con éxito.');
    }
}
