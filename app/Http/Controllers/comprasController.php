<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Compras;
use \App\Proveedores;
use App\Productos;
use \App\Compras_detalle;
use Illuminate\Support\Facades\DB;
use Flash;

class comprasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
    

        $compras = DB::table('compras as c')
                    ->join('compra_detalle as cd','c.id_compra','=','cd.id_compra')
                    ->join('proveedores as p','c.id_proveedor','=','p.id_proveedor')
                    ->select('c.id_compra','c.folio','c.comprobante',DB::raw('concat(p.nombre," ",p.ape_paterno," ",p.ape_materno) as fullname'),DB::raw('SUM(cd.cantidad * precio_compra) AS total'))
                    ->orderBy('c.id_compra','asc')
                    ->groupBy('c.id_compra','c.folio','c.comprobante')
                    ->paginate(10);
        $count = Compras::count();            

        return view('compras.index')
                    ->with('compras',$compras)
                    ->with('count',$count);
    }

    
    public function loadPage(Request $request){
    
        if ($request->ajax()) {

        $compras = DB::table('compras as c')
                    ->join('compra_detalle as cd','c.id_compra','=','cd.id_compra')
                    ->join('proveedores as p','c.id_proveedor','=','p.id_proveedor')
                    ->select('c.id_compra','c.folio','c.comprobante',DB::raw('concat(p.nombre," ",p.ape_paterno," ",p.ape_materno) as fullname'),DB::raw('SUM(cd.cantidad * precio_compra) AS total'))
                    ->orderBy('c.id_compra','asc')
                    ->groupBy('c.id_compra','c.folio','c.comprobante')
                    ->paginate(10);
        $count = Compras::count();
         return view('compras.table')
                    ->with('compras',$compras)
                    ->with('count',$count)->render();
     
     }
    }


    public function create()
    {
        $proveedores = DB::table('proveedores')
        ->where('activo','=',1)
        ->get();

        $productos = DB::table('productos')
        ->where('estado','=',1)
        ->get();

        return view('compras.create')
                    ->with('proveedores',$proveedores)
                    ->with('productos',$productos);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){

            $compra = new Compras;

            $compra->folio = $request->folio;
            $compra->comprobante = $request->comprobante;
            $compra->id_proveedor = $request->proveedores;
            $compra->activo = 1;

            $compra->save();


            return response()->json(['data'=>$compra->id_compra]);
        
    }


    public function insert_detalle_compra(Request $request){
    
        if ($request->ajax()) {
                $detalles = $request->all();

                

                foreach ($detalles as $detalle ) {
                     
                     foreach ($detalle as  $detalle2) {
                        $compra_detalle = new Compras_detalle;

                        $compra_detalle->id_compra = $detalle2[0];
                        $compra_detalle->cantidad = $detalle2[1];
                        $compra_detalle->id_producto = $detalle2[2];
                        $compra_detalle->precio_compra = $detalle2[3];
                        $compra_detalle->precio_venta = $detalle2[4];

                        $compra_detalle->save();
                         
                     }
                   
                }
            }

        return response()->json(['data'=>$detalles]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request){
    
        if ($request->ajax()) {
            $id_compra = $request->input('id_compra');

            $detalle_com = DB::table('compra_detalle as cd')
                           ->join('productos AS pro','cd.id_producto','=' ,'pro.id_producto') 
                           ->select('cd.cantidad',DB::raw('CONCAT(pro.nombre," ",pro.descripcion) AS producto'),'cd.precio_compra','cd.precio_venta')
                           ->where('cd.id_compra','=',$id_compra)
                           ->get();

            return response()->json($detalle_com);
           
        }
    }

   public function filter(Request $request){
    
    
    if ($request->ajax()) {
        $query = $request->get('query');
            //dd(gettype($query));
        if ($query != '') {
             $compras = DB::table('compras as c')
                    ->join('compra_detalle as cd','c.id_compra','=','cd.id_compra')
                    ->join('proveedores as p','c.id_proveedor','=','p.id_proveedor')
                    ->select('c.id_compra','c.folio','c.comprobante',DB::raw('concat(p.nombre," ",p.ape_paterno," ",p.ape_materno) as fullname'),DB::raw('SUM(cd.cantidad * precio_compra) AS total'))
                    ->where('c.folio','LIKE','%'.$query.'%')
                    ->orWhere('c.comprobante','LIKE','%'.$query.'%')
                    ->orWhere('p.nombre','LIKE','%'.$query.'%')
                    ->orWhere('p.ape_paterno','LIKE','%'.$query.'%')
                    ->orWhere('p.ape_materno','LIKE','%'.$query.'%')
                    ->orderBy('c.id_compra','asc')
                    ->groupBy('c.id_compra','c.folio','c.comprobante')
                    ->paginate(50);
            $count = Compras::count();  

            

            
        }else{
            $compras = DB::table('compras as c')
                    ->join('compra_detalle as cd','c.id_compra','=','cd.id_compra')
                    ->join('proveedores as p','c.id_proveedor','=','p.id_proveedor')
                    ->select('c.id_compra','c.folio','c.comprobante',DB::raw('concat(p.nombre," ",p.ape_paterno," ",p.ape_materno) as fullname'),DB::raw('SUM(cd.cantidad * precio_compra) AS total'))
                    ->orderBy('c.id_compra','asc')
                    ->groupBy('c.id_compra','c.folio','c.comprobante')
                    ->paginate(10);
            $count = Compras::count();            
            
        }

        $total_registros = $compras->count();

        
        return view('compras.table')->with('compras',$compras)
        ->with('count',$total_registros)
        ->render();
    }
}
}
