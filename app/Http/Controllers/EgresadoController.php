<?php

namespace App\Http\Controllers;

use App\Models\Egresado;
use App\Models\MoodleUser;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\File as FileRule;
class EgresadoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('dashboard.egresado.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, MoodleUser $user)
    {
        $this->validate($request, [
            'mdl_user_id'=> 'required|integer',
            'especialidad'  => 'nullable|string|max:100',
            'programa_estudios' => 'nullable|string|max:100',
            'ingreso'   => 'nullable|string|max:100',
            'egreso'    => 'nullable|string|max:100',
            'nivel' => 'nullable|string|max:100',
            'parentesco'    => 'nullable|string|max:100',
            'fullname'  => 'nullable|string|max:100',
            'num_documento' => 'nullable|string|max:100',
            'direccion' => 'nullable|string|max:100',
            'email' => 'nullable|string|max:100',
            'phone' => 'nullable|string|max:100',
            'empresa'   => 'nullable|string|max:100',
            'ocupacion' => 'nullable|string|max:100',
            'email_empresa' => 'nullable|string|max:100',
            'direccion_empresa' => 'nullable|string|max:100',
            "evidencia_file"   => ['nullable',FileRule::types(['pdf'])->max(5 * 1024)]
        ]);
        /*if($request->file()) {
            $name = time().'_'.$request->egresado_file->getClientOriginalName();
            $fileUrl = $request->file('egresado_file')->storeAs('uploads/egresados', $name, 'public');
            //$data->pdf_path = time().'_'.$request->egresado_file->getClientOriginalName();
            $data->pdf_url = '/storage/' . $fileUrl;
            $data->save();
        }*/
        $data = $request->all();
        Egresado::updateOrInsert(['mdl_user_id'=>$user->id],$data);
        return response()->json(['message'=>"Datos Guardados"], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(Egresado $egresados,MoodleUser $user)
    {
        $egresado = Egresado::where('mdl_user_id',$user->id)->first();
            if (!$egresado) {
            //inicializamos los atributos del objeto en  ""         
            $modelo = new Egresado();
            $atributos = $modelo->getFillable();
            $egresado=[];
            foreach ($atributos as $atributo) {
                $egresado[$atributo]="";
            }
        }
        return response()->json(['egresado'=>$egresado], 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Egresado $egresados)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Egresados $egresados)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Egresado $egresados)
    {
        //
    }
}
