<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateTrabajadoresRequest;
use App\Http\Requests\UpdateTrabajadoresRequest;
use App\Repositories\TrabajadoresRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use App\Models\Trabajadores;
use Illuminate\Support\Facades\DB;


class TrabajadoresController extends AppBaseController
{
    /** @var  TrabajadoresRepository */
    private $trabajadoresRepository;

    public function __construct(TrabajadoresRepository $trabajadoresRepo)
    {
        $this->trabajadoresRepository = $trabajadoresRepo;
        $this->middleware('auth');
    }


    public function index()
    {
        $trabajadores = DB::table('trabajadores')->paginate(10);
        $count = Trabajadores::count();
        return view('trabajadores.index')
                ->with('count',$count)
                ->with('trabajadores',$trabajadores);
    }

       public function loadPage(Request $request)
    {
        if ($request->ajax()) {
           $trabajadores = DB::table('trabajadores')->paginate(10);
           $count = Trabajadores::count();
            return view('trabajadores.table')
                ->with('count',$count)
                ->with('trabajadores',$trabajadores)->render();
        }
    }

    public function create()
    {
        return view('trabajadores.create');
    }


    public function store(Request $request){
        if ($request->ajax()) {
            # code...
            $trabajador = new Trabajadores;
            
            $trabajador->nombre = $request->nombre;
            $trabajador->apellido_pat = $request->apellido_pat;
            $trabajador->apellido_mat = $request->apellido_mat;
            //conversion de fecha al formato de mysql
            $time = strtotime($request->fecha_nac);
            $newformat = date('Y-m-d',$time);
            
            $trabajador->fecha_nac = $newformat;
            $trabajador->foto = $request->foto;
            $trabajador->huella_digital = $request->huella_digital;
            $trabajador->activo = 1;
            $trabajador->save();
            $newDate = date("d/m/Y", strtotime($trabajador->fecha_nac));
            return response()->json(['data'=>$trabajador,'date'=>$newDate]);

            
        }
        
    }


    public function show($id)
    {
        $trabajadores = $this->trabajadoresRepository->findWithoutFail($id);

        if (empty($trabajadores)) {
            Flash::error('Trabajador no encontrado.');

            return redirect(route('trabajadores.index'));
        }
        

        return view('trabajadores.show')->with('trabajadores', $trabajadores);
    }

 
    public function edit(Request $request){
        $id = $request->input('id_trabajador');
        $trabajador = Trabajadores::find($id);
        $newDate2 = date("d/m/Y", strtotime($trabajador->fecha_nac));
        return response()->json(['data'=>$trabajador,'fecha_edit'=>$newDate2]);
    }

    public function update(Request $request){
     if ($request->ajax()) {
            $id = $request->input('id_update_trab');
            $trabajador = Trabajadores::find($id);
            $trabajador->nombre = $request->nombre_edit;
            $trabajador->apellido_pat = $request->ape_pat_edit;
            $trabajador->apellido_mat = $request->ape_mat_edit;
            //conversion de fecha al formato de mysql
            $time = strtotime($request->fecha_nac_edit);
            $newformat = date('Y-m-d',$time);
            
            $trabajador->fecha_nac = $newformat;
            $trabajador->foto = $request->foto_edit;
            $trabajador->huella_digital = $request->huella_edit;
            $trabajador->save();
            $newDate = date("d/m/Y", strtotime($trabajador->fecha_nac));
            return response()->json(['data' => $trabajador,'date'=>$newDate]);
        }

        
    }


    public function destroy(Request $request)
    {
         $id = $request->input('id_delete');
        $trabajador = Trabajadores::where('id','=',$id)->firstOrFail();
        if ($trabajador->activo == 1) {
            $estado =  0;
            DB::update('update trabajadores set activo = ? where id = ?',[$estado,$id]);
            return response()->json(['data'=>$estado]);   
        }else{
            $estado =  1;
            DB::update('update trabajadores set activo = ? where id = ?',[$estado,$id]);
            return response()->json(['data'=>$estado]);
        }
    }
}