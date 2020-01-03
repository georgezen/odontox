<?php

namespace App\Http\Controllers;

use App\PresentacionProducto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PresentacionProductoController extends Controller
{
    public function __construct()
    {

        $this->middleware('auth');
    }

     
    public function index()
    {
        

        $presentaciones = DB::table('presentacion')->paginate(10);
        $count = PresentacionProducto::count();
        return view('presentaciones.index')
                ->with('count',$count)
                ->with('presentaciones',$presentaciones);
    }


    public function loadPage(Request $request)
    {
        if ($request->ajax()) {
          $presentaciones = DB::table('presentacion')->paginate(10);
        $count = PresentacionProducto::count();
        return view('presentaciones.table')
                ->with('count',$count)
                ->with('presentaciones',$presentaciones);
        }
    }

    public function store(Request $request)
    {
         if ($request->ajax()) {
  
            $presentacion = new PresentacionProducto;

       
            
            $presentacion->descripcion = $request->descripcion;
            $presentacion->save();
            return response()->json(['data'=>$request->all(),'id_presentacion'=>$presentacion->id_presentacion]);
        }
    }
 
    public function edit(Request $request){
    
        if ($request->ajax()) {

            $id = $request->input('id_presentacion');
            $presentacion = PresentacionProducto::find($id);


            return response()->json(['data'=>$presentacion->descripcion,'id_presentacion'=>$presentacion->id_presentacion]);
        }
    }

    public function update(Request $request){
    
        if ($request->ajax()) {
            $id = $request->input('id_presentacion_edit');
            $presentacion = PresentacionProducto::find($id);
            $presentacion->descripcion = $request->edit_presentacion;
            $presentacion->save();

            return response()->json(['data'=>$presentacion->descripcion,'id_presentacion'=>$presentacion->id_presentacion]);
        }
    }

  
}
