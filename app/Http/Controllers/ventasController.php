<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Productos;
use Illuminate\Support\Facades\DB;
use App\Ventas_detalle;
use App\Ventas;
use App\Clientes;

class ventasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request){
    
        $ventas = DB::table('ventas as v')
                  ->select('v.id_venta','v.tipo_comprobante','v.folio',DB::raw('CONCAT (c.`nombre`," ",c.`ape_paterno`," ",c.`ape_materno`) AS fullname'),'v.total') 
                  ->join('clientes as c','v.id_cliente','=','c.id_cliente')
                  ->paginate(10);
        $count = Ventas::count();          

        return view('ventas.index')
                ->with('count',$count)
                ->with('ventas',$ventas)->render();
    }

    public function loadPage(Request $request){
    
        if ($request->ajax()) {
            $ventas = DB::table('ventas as v')
                  ->select('v.id_venta','v.tipo_comprobante','v.folio',DB::raw('CONCAT (c.`nombre`," ",c.`ape_paterno`," ",c.`ape_materno`) AS fullname'),'v.total') 
                  ->join('clientes as c','v.id_cliente','=','c.id_cliente')
                  ->paginate(10);
            $count = Ventas::count();          

            return view('ventas.table')
                    ->with('count',$count)
                    ->with('ventas',$ventas)->render();
        
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $clientes = DB::table('clientes')
                    ->select('id_cliente',DB::raw('concat(nombre," ",ape_paterno," ",ape_materno) as full_na'))
                    ->where('activo','=',1)
                    ->get();

        $productos = DB::table('productos')            
                     ->select('id_producto',DB::raw('concat(nombre," ",descripcion) as producto'))
                     ->where('estado','=',1)
                    ->get();





        return view('ventas.create')
                ->with('clientes',$clientes)
                ->with('productos',$productos);
    }


    public function get_info_producto(Request $request){
    
        if ($request->ajax()) {
            $producto = $request->get_producto;

            $id = DB::table('compra_detalle as cp')
                  ->join('productos as p','cp.id_producto','=','p.id_producto')
                  ->select(DB::raw('AVG(cp.precio_venta) as precio_promedio'),'p.stock')  
                  ->where('p.id_producto','=',$producto)
                  ->groupBy('p.stock')
                  ->get();

            

            return response()->json($id);      
        }
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
    
        $venta = new Ventas;
        
        $venta->id_cliente = $request->cliente;
        $venta->tipo_comprobante = $request->comprobante;
        $venta->folio = $request->folio;
        $venta->total = $request->total;
        $venta->activo = 1;

        $venta->save();

        return response()->json(['data'=>$venta->id_venta]);
    }



    public function insert_detalle_venta(Request $request){
    
        
        if ($request->ajax()) {
            $venta_detalles =  $request->all();

            foreach ($venta_detalles as $venta_detalle) {
                    
                foreach ($venta_detalle as $venta2) {


                    $venta_detalle = new Ventas_detalle;
                    $venta_detalle->id_venta = $venta2[0];
                    $venta_detalle->id_producto = $venta2[1];
                    $venta_detalle->cantidad = $venta2[2];
                    $venta_detalle->precio_venta = $venta2[3];
                    $venta_detalle->descuento = $venta2[4];

                    $venta_detalle->save();
                }
            }

            return response()->json(['data'=>$venta_detalles]);
        }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function load_id_detalle_venta(Request $request){
            if ($request->ajax()) {
            $id_venta = $request->input('id_venta');

            $detalle_vent = DB::table('detalle_venta as dv')
                           ->join('productos AS pro','dv.id_producto','=' ,'pro.id_producto') 
                           ->join('ventas as v','dv.id_venta','=','v.id_venta')
                           ->select('dv.cantidad',DB::raw('CONCAT(pro.nombre," ",pro.descripcion) AS producto'),'dv.precio_venta','dv.descuento','v.total')
                           ->where('dv.id_venta','=',$id_venta)
                           ->get();

            return response()->json($detalle_vent);
           
        }
    
        
    }


    public function filter(Request $request){
    
    
    if ($request->ajax()) {
        $query = $request->get('query');
            //dd(gettype($query));
        if ($query != '') {

            $ventas = DB::table('ventas as v')
                  ->select('v.id_venta','v.tipo_comprobante','v.folio',DB::raw('CONCAT (c.`nombre`," ",c.`ape_paterno`," ",c.`ape_materno`) AS fullname'),'v.total') 
                  ->join('clientes as c','v.id_cliente','=','c.id_cliente')
                  ->where('v.tipo_comprobante','LIKE','%'.$query.'%')
                  ->orWhere('v.folio','LIKE','%'.$query.'%')
                  ->orWhere('c.nombre','LIKE','%'.$query.'%')
                  ->orWhere('c.ape_paterno','LIKE','%'.$query.'%')
                  ->orWhere('c.ape_materno','LIKE','%'.$query.'%')
                  ->orderBy('v.id_venta','asc')
                  ->paginate(50);
            $count = Ventas::count();          
            

            
        }else{
            $ventas = DB::table('ventas as v')
                      ->select('v.id_venta','v.tipo_comprobante','v.folio',DB::raw('CONCAT (c.`nombre`," ",c.`ape_paterno`," ",c.`ape_materno`) AS fullname'),'v.total') 
                      ->join('clientes as c','v.id_cliente','=','c.id_cliente')
                      ->paginate(10);
            
        }

        $total_registros = $ventas->count();

        
        return view('ventas.table')->with('ventas',$ventas)
        ->with('count',$total_registros)
        ->render();
    }
}
}
