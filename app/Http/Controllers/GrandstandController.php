<?php

namespace App\Http\Controllers;

use App\Models\grandstand;
use Illuminate\Http\Request;

class GrandstandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $grandstands['grandstands'] = grandstand::paginate(10);
        return view('pages.grandstand.grandstandAdm', $grandstands);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.grandstand.grandstandAdd');
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
            'grandstandname'=>'required | max:100 | unique:grandstands',
            'description'=>'required | max:500'
        ],
        [
            'grandstandname.required' => 'Este campo es requerido',
            'description.required' => 'Este campo es requerido',     
            'grandstandname.max' => 'El máximo de caracteres es 100',
            'description.max' => 'El máximo de caracteres es 500',
            'grandstandname.unique' => 'Nombre ya utilizado'
        ]
        );

        $data = request()->except('_token');

        $dataToSend = new grandstand();
        $dataToSend = $data;

        grandstand::insert($dataToSend);

        return redirect('/grandstand')->with('mensaje','Gradería creada con éxito.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\grandstand  $grandstand
     * @return \Illuminate\Http\Response
     */
    public function show(grandstand $grandstand)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($grandstandid)
    {
        $grandstand = grandstand::findOrFail($grandstandid);
        return view('pages.grandstand.grandstandEdit', compact('grandstand'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\grandstand  $grandstand
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $grandstandId)
    {
        $request->validate([
            'grandstandname'=>'required | max:100',
            'description'=>'required | max:500'
        ],
        [
            'grandstandname.required' => 'Este campo es requerido',
            'description.required' => 'Este campo es requerido',     
            'grandstandname.max' => 'El máximo de caracteres es 100',
            'description.max' => 'El máximo de caracteres es 500'
        ]
        );

        $data = request()->except('_token', '_method');

        $dataToSend = new grandstand();
        $dataToSend = $data;

        grandstand::where('grandstandid', '=', $grandstandId)->update($dataToSend);
        
        return redirect('/grandstand')->with('mensaje','Gradería editada con éxito.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\grandstand  $grandstand
     * @return \Illuminate\Http\Response
     */
    public function destroy($grandstandid)
    {
        grandstand::destroy($grandstandid);  
        return redirect('/grandstand')->with('mensaje','Gradería eliminada con éxito.');
    }
}
