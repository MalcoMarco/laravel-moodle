<?php

namespace App\Http\Controllers;

use App\Models\Silabus\Silabu;
use App\Models\Silabus\SilabuReq;
use App\Models\StateType;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Validation\Rules\File;
use Illuminate\Support\Facades\DB;
use Storage;
class SilabuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('dashboard.silabus.list');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $silaboReqs=SilabuReq::all();
        return view('dashboard.silabus.create',compact('silaboReqs'));
    }

    public function list(Request $request)
    {
        $query = $request->q ?? '';
        $perPage = $request->perPage ?? 15;
        $orderBy = $request->sortBy ?? 'updated_at';
        $orderMode = $request->sortDesc=='true' ? 'desc':'asc';
        
        //user es siteAdmin Lista todos los silabos
        if (Auth::user()->isSiteadmin()) {
            return Silabu::search($query)
            ->query(function ($builder) {
                $builder->join('state_types','state_types.id','state_type_id')
                ->join(config('app.db_name_moodle').'.mdl_user','mdl_user.id','mdl_user_id')
                ->select('silabus.id','name as status','guard_name as status_guard_name',
                'curso_name','escuela','ciclo','creditos','horas_teoricas','horas_practicas',
                'pdf_url','updated_at','firstname','lastname');
            })
            ->orderBy($orderBy ,$orderMode)        
            ->paginate($perPage);
        }

        return Silabu::search($query)->where('mdl_user_id',Auth::user()->id)
        ->query(function ($builder) {
            $builder->join('state_types','state_types.id','state_type_id')
            ->select('silabus.id','name as status','guard_name as status_guard_name',
            'curso_name','escuela','ciclo','creditos','horas_teoricas','horas_practicas',
            'pdf_url','updated_at');
        })
        ->orderBy($orderBy ,$orderMode)        
        ->paginate($perPage);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'curso_name'        => 'required|string|max:125',
            'escuela'           => 'required|string|max:125',
            'ciclo'             => 'nullable|string|max:125',
            'creditos'          => 'nullable|integer|max:125',
            'horas_teoricas'    => 'nullable|integer|max:125',
            'horas_practicas'   => 'nullable|integer|max:125',

            "silabo_file"   => ['required',File::types(['pdf'])->max(5 * 1024)]
        ]);

        $statusEnRevicion = StateType::where('guard_name','ER')->first();
        $silabo = new Silabu();

        $silabo->mdl_user_id = Auth::user()->id;
        $silabo->state_type_id = $statusEnRevicion->id;
        $silabo->curso_name = $request->curso_name;
        $silabo->escuela = $request->escuela;
        $silabo->ciclo = $request->ciclo;
        $silabo->creditos = $request->creditos;
        $silabo->horas_teoricas = $request->horas_teoricas;
        $silabo->horas_practicas = $request->horas_practicas;


        if($request->file()) {
            $name = time().'_'.$request->silabo_file->getClientOriginalName();
            $fileUrl = $request->file('silabo_file')->storeAs('uploads', $name, 'public');
            $silabo->pdf_path = time().'_'.$request->silabo_file->getClientOriginalName();
            $silabo->pdf_url = '/storage/' . $fileUrl;
            $silabo->save();
        }

        return redirect()->route('silabus.index'); 
    }

    /**
     * Display the specified resource.
     */
    public function review($silabu)
    {
        $silaboReqs=SilabuReq::all();
        $silabu = Silabu::with('incomplete_reqs')->findOrFail($silabu);
    
        //return compact('silaboReqs','silabu');
        
        return view('dashboard.silabus.review',compact('silaboReqs','silabu'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function makereview(Request $request, $silabo)
    {
       //return $request->all();

        $silabu = Silabu::findOrFail($silabo);
        //return var_dump($request->all());
        DB::table('silabu_incomplete_reqs')->where('silabu_id', $silabu->id)->delete();
        if ($request->requisitos) {
            foreach ($request->requisitos as $requisito) {    
                $silabu->incomplete_reqs()->attach($requisito["id"], [
                    'description' => $requisito["description"],
                  ]);
            }
            $silabu->state_type_id = 4; // id en revicion
            $silabu->save();
        }else{
            //aprobar
            $silabu->state_type_id = 5; // id aprobado
            $silabu->save();
        }
        return redirect()->route('silabus.review',$silabo)->with('status', 'Datos Actualizados!');; 
    }

    public function observacion($silabu)
    {
        //$silaboReqs=SilabuReq::all();
        $silabo = Silabu::with('incomplete_reqs')->findOrFail($silabu);
        //return compact('silabu');
        
        return view('dashboard.silabus.observacion',compact('silabo'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function observacionUpdate(Request $request, Silabu $silabo)
    {
        
        if (Auth::user()->id != $silabo->mdl_user_id) {
            abort(403, 'Acción no autorizada.');
        }

        $this->validate($request, [
            "silabo_file"   => ['required',File::types(['pdf'])->max(5 * 1024)]
        ]);
        $fileToDeletePath = $silabo->pdf_url;
        if($request->file()) {
            $statusEnRevicion = StateType::where('guard_name','ER')->first();

            $silabo->state_type_id = $statusEnRevicion->id;

            $name = time().'_'.$request->silabo_file->getClientOriginalName();
            $fileUrl = $request->file('silabo_file')->storeAs('uploads', $name, 'public');
            $silabo->pdf_path = time().'_'.$request->silabo_file->getClientOriginalName();
            $silabo->pdf_url = '/storage/' . $fileUrl;
            $silabo->save();
            
            if(Storage::exists($fileToDeletePath)){
                Storage::delete($fileToDeletePath);
            }
        }

        return redirect()->route('silabus.index'); 
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Silabu $silabu)
    {
        if (Auth::user()->id != $silabu->mdl_user_id) {
            abort(403, 'Acción no autorizada.');
        }
        $fileToDeletePath = $silabu->pdf_url;
        $silabu->delete();
        if(Storage::exists($fileToDeletePath)){
            Storage::delete($fileToDeletePath);
        }
        return response()->json(['message'=>"Se ha eliminado un elemento"], 200);
    }

    /*
     |--------------------------------------------------------------------------
     | SILABU-REQS
     |--------------------------------------------------------------------------
     * 
     */

     /**
     * Show the form silabu_reqs.
     */
    public function form_silabuReqs()  {
        return view('dashboard.silabus.requisitos');
    }

     /**
     * return all silabu_reqs.
     */
    public function list_silabuReqs()  {
        return SilabuReq::simplePaginate(100);
    }

     /**
     * create silabu_reqs.
     */
    public function create_silabuReqs(Request $request)  {
        $this->validate($request, [
            'name' => 'required|string|max:125',
            'orden' => 'nullable|integer',
        ]);
        $silabuReq = new SilabuReq();
        $silabuReq->name = $request->name;
        $silabuReq->orden = $request->orden;
        $silabuReq->save();
        return response()->json(['message'=>"creado"], 200);
    }

     /**
     * update silabu_reqs.
     */
    public function update_silabuReqs(Request $request, SilabuReq $silabuReq)  {
        $this->validate($request, [
            'name' => 'required|string|max:125',
            'orden' => 'nullable|integer',
        ]);

        $silabuReq->name = $request->name;
        $silabuReq->orden = $request->orden;
        $silabuReq->save();
        return response()->json(['message'=>"actualizado"], 200);
    }

    function destroy_silabuReqs(SilabuReq $silabuReq){
        $silabuReq->delete();
        return response()->json(['message'=>"Eliminado"], 200);
    }
}
