<?php

namespace App\Http\Controllers;

use App\Models\Disciplines;
use Illuminate\Http\Request;

class DisciplinesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $disciplines['disciplines'] = Disciplines::paginate(10);
        return view('pages.disciplines.disciplinesAdm', $disciplines);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.disciplines.disciplinesAdd');
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

        $dataToSend = new Disciplines();
        $dataToSend = $data;

        Disciplines::insert($dataToSend);

        return redirect('/discipline')->with('mensaje','Disciplina creada con éxito.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Disciplines  $disciplines
     * @return \Illuminate\Http\Response
     */
    public function show(Disciplines $disciplines)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Disciplines  $disciplines
     * @return \Illuminate\Http\Response
     */
    public function edit($disciplineId)
    {
        //
        $discipline = Disciplines::findOrFail($disciplineId);
        return view('pages.disciplines.disciplinesEdit', compact('discipline'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Disciplines  $disciplines
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $disciplineId)
    {
        $data = request()->except('_token', '_method');

        $dataToSend = new Disciplines();
        $dataToSend = $data;

        Disciplines::where('id', '=', $disciplineId)->update($dataToSend);
        
        return redirect('/discipline')->with('mensaje','Disciplina editada con éxito.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Disciplines  $disciplines
     * @return \Illuminate\Http\Response
     */
    public function destroy($disciplineId)
    {
        // $discipline = Disciplines::findOrFail($discipline_id);
        Disciplines::destroy($disciplineId);   
        return redirect('/discipline')->with('mensaje','Disciplina eliminada con éxito.');
    }
}
