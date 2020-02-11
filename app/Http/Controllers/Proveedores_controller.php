<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Proveedores;
use Illuminate\Support\Facades\DB;

class Proveedores_controller extends Controller
{

    public function index(){

        $proveedores = DB::table('proveedores')->paginate(10);
                        
    
        return view('proveedores.index')->with('proveedores',$proveedores);
    }


    public function store(Request $request){

        $proveedor = new Proveedores();

        $proveedor->nombre = $request->nombre;
        $proveedor->ape_paterno = $request->ape_paterno;
        $proveedor->ape_materno = $request->ape_materno;
        $proveedor->telefono = $request->telefono;
        $proveedor->calle = $request->calle;
        $proveedor->colonia = $request->colonia;
        $proveedor->num_exterior = $request->num_exterior;
        $proveedor->municipio = $request->municipio;
        $proveedor->estado = $request->estado;
        $proveedor->pais = $request->pais;
        $proveedor->activo == 1;

        $proveedor->save();

        return response()->json(['data'=>$proveedor]);
    }


    public function loadPage(Request $request){
    
       if ($request->ajax()) {
           $proveedores = DB::table('proveedores')->paginate(10);
           $count = Proveedores::count();
            return view('proveedores.table')
                    ->with('count',$count)
                    ->with('proveedores',$proveedores)->render();
        }
    }



    public function edit(Request $request)
    {
        if ($request->ajax()) {

            $id = $request->input('id_proveedor');
            $proveedores = Proveedores::find($id);
            return response()->json(['data'=>$proveedores]);
        }
    }


    public function filter(Request $request){
        
        if ($request->ajax()) {
        $query = $request->get('query');
            //dd(gettype($query));
        if ($query != '') {
            $data = DB::table('proveedores')
                            ->where('nombre','LIKE','%'.$query.'%')
                            ->orWhere('ape_paterno','LIKE','%'.$query.'%')
                            ->orWhere('ape_materno','LIKE','%'.$query.'%')
                            ->orWhere('telefono','LIKE','%'.$query.'%')
                            ->orWhere('calle','LIKE','%'.$query.'%')
                            ->orWhere('num_exterior','LIKE','%'.$query.'%')
                            ->orWhere('colonia','LIKE','%'.$query.'%')
                            ->paginate(50); 
        
            
        }else{
            $data = DB::table('productos')
            ->orderBy('id_producto','asc')
            ->paginate(10);
            
        }

        $total_registros = $data->count();

        
        return view('proveedores.table')->with('proveedores',$data)
        ->with('count',$total_registros)
        ->render();
    }
        
    }


    public function update(Request $request){

       if ($request->ajax()) {



        $id = $request->input('id_update_prov');
        $proveedor = Proveedores::find($id);
        $proveedor->nombre = $request->nombre;
        $proveedor->ape_paterno = $request->ape_paterno;
        $proveedor->ape_materno = $request->ape_materno;
        $proveedor->telefono = $request->telefono;
        $proveedor->calle = $request->calle;
        $proveedor->colonia = $request->colonia;
        $proveedor->num_exterior = $request->num_exterior;
        $proveedor->municipio = $request->municipio;
        $proveedor->estado = $request->estado;
        $proveedor->pais = $request->pais;
        $proveedor->save();

        return response()->json(['data'=>$proveedor]);
    }
}


    public function destroy(Request $request)
    {
        $id = $request->input('id_delete');
        $proveedor = Proveedores::where('id_proveedor','=',$id)->firstOrFail();
        if ($proveedor->activo == 1) {
            $estado =  0;
            DB::update('update proveedores set activo = ? where id_proveedor = ?',[$estado,$id]);
            return response()->json(['data'=>$estado]);   
        }else{
            $estado =  1;
            DB::update('update proveedores set activo = ? where id_proveedor = ?',[$estado,$id]);
            return response()->json(['data'=>$estado]);
        }
    }
}
