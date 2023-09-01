<?php

namespace App\Http\Controllers;

use App\Models\HistorialClinico;
use Illuminate\Http\Request;

class HistorialClinicoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('dashboard.historialClinico.buscar');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.historialClinico.crear');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'mdl_user_id'=> 'required|integer',
            'talla'=> 'nullable|string|max:20',
            'peso'=> 'nullable|string|max:20',
            'imc'=> 'nullable|string|max:20',
            'grupo_sanguineo'=> 'nullable|string|max:20',
            'alergia'=> 'nullable',
            'alergia_especifique'=> 'nullable|string|max:100',
            'enfermedad'=> 'nullable',
            'enfermedad_especifique'=> 'nullable|string|max:200',
            'fecha_consulta'=> 'required',
            'hora_consulta'=> 'required',
            'motivo'=> 'nullable|string',
            'examen_fisico'=> 'nullable|string',
            'diagnostico'=> 'nullable|string|max:200',
            'tratamiento'=> 'nullable|string',
            'observacion'=> 'nullable|string|max:200',
            'personal_a_cargo'=> 'nullable|string|max:200',
            'pa'=> 'nullable|string|max:20',
            'fc'=> 'nullable|string|max:20',
            'fr'=> 'nullable|string|max:20',
            'tc'=> 'nullable|string|max:20',

        ]);
        $data = $request->all();
        $data['enfermedad']=implode(', ', $request->enfermedad);
        HistorialClinico::create($data);
        return response()->json(['message'=>"Datos Guardados"], 200);

    }


    public function historial(Request $request, $user)
    {
        $historialClinico = HistorialClinico::where('mdl_user_id',$user)
        ->orderBy('fecha_consulta','desc')
        ->orderBy('hora_consulta','desc')
        ->paginate(150);
        return response()->json(['historialClinico'=>$historialClinico], 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(HistorialClinico $historialClinico)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, HistorialClinico $historialClinico)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(HistorialClinico $historialClinico)
    {
        //
    }
}
