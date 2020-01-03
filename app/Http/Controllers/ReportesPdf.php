<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDF;
use \App\Productos;
use Illuminate\Support\Facades\DB;

class ReportesPdf extends Controller{

    public function index(){
    	$header = "Reporte de stock de productos";

    	$productos = DB::table('productos')
    				 ->select('id_producto','codigo','nombre','descripcion','stock')
    				 ->get();

    	 $pdf = PDF::loadView('reportes.datos_almacen',['header'=>$header,'productos'=>$productos]);
     	return $pdf->stream('ejemplo.pdf');

    }
}
