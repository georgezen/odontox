<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Productos;
use Illuminate\Support\Facades\DB;


class Almacen_controller extends Controller
{

    public function show(Request $request){
    

        $productos = DB::table('productos')
                     ->select('id_producto','codigo','nombre','descripcion','stock')
                     ->paginate(10);

        $count = Productos::count();             
                     
        return view("almacen.index")
               ->with('count',$count)
               ->with('productos',$productos)->render();
    }

    public function loadPage(Request $request){
    
        if ($request->ajax()) {
         $productos = DB::table('productos')->paginate(10);

         $count = Productos::count();
         
         return view('almacen.table')
         ->with('count',$count)
         ->with('productos',$productos)->render();
     }
    }


    public function filter(Request $request){
    
    
    if ($request->ajax()) {
        $query = $request->get('query');
            //dd(gettype($query));
        if ($query != '') {
            $data = DB::table('productos')
            ->where('codigo','LIKE','%'.$query.'%')
            ->orWhere('nombre','LIKE','%'.$query.'%')
            ->orWhere('descripcion','LIKE','%'.$query.'%')
            ->orderBy('id_producto','asc')
            ->paginate(50);

            
        }else{
            $data = DB::table('productos')
            ->orderBy('id_producto','asc')
            ->paginate(10);
            
        }

        $total_registros = $data->count();

        
        return view('almacen.table')->with('productos',$data)
        ->with('count',$total_registros)
        ->render();
    }
}


}
