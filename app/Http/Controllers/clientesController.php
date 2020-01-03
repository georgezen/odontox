<?php

namespace App\Http\Controllers;


use \App\Clientes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class clientesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

       $clientes = DB::table('clientes')->paginate(10); 

       $count = Clientes::count();
       return view('clientes.index')
                    ->with('clientes',$clientes)
                    ->with('count',$count);
                                   
    }


    public function store(Request $request){
    
        if ($request->ajax()) {
            $cliente = new Clientes;

            $cliente->nombre = $request->nombre;
            $cliente->ape_paterno = $request->ape_paterno;
            $cliente->ape_materno = $request->ape_materno;
            $cliente->edad = $request->edad;
            $cliente->telefono = $request->telefono;
            $cliente->calle = $request->calle;
            $cliente->num_exterior = $request->num_exterior;
            $cliente->colonia = $request->colonia;
            $cliente->ciudad = $request->ciudad;
            $cliente->estado = $request->estado;
            $cliente->pais = $request->pais;
            $cliente->save();

            return response()->json(['data'=>$cliente]);

        }
    }

    public function loadPage(Request $request){
    
        if ($request->ajax()) {

        $clientes = DB::table('clientes')->paginate(10); 

        $count = Clientes::count();
        return view('clientes.table')
                    ->with('clientes',$clientes)
                    ->with('count',$count)->render();            
     
     }
    }

    public function edit(Request $request){
    

        if($request->ajax()) {

            $id = $request->input('id_cliente');
            $cliente = Clientes::find($id);
            return response()->json(['data'=>$cliente]);
        }
    
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
       if ($request->ajax()) {



        $id = $request->input('id_cliente_upd');
        $cliente = Clientes::find($id);
        $cliente->nombre = $request->nombre_edit;
        $cliente->ape_paterno = $request->ape_paterno_edit;
        $cliente->ape_materno = $request->ape_materno_edit;
        $cliente->edad = $request->edad_edit;
        $cliente->telefono = $request->telefono_edit;
        $cliente->calle = $request->calle_edit;
        $cliente->num_exterior = $request->num_exterior_edit;
        $cliente->colonia = $request->colonia_edit;
        $cliente->ciudad = $request->ciudad_edit;
        $cliente->estado = $request->estado_edit;
        $cliente->pais = $request->pais_edit;
        $cliente->save();

        return response()->json(['data'=>$cliente]);
    }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request){
    
        $id = $request->input('id_delete');
        $cliente = Clientes::where('id_cliente','=',$id)->firstOrFail();
        if ($cliente->activo == 1) {
            $estado =  0;
            DB::update('update clientes set activo = ? where id_cliente = ?',[$estado,$id]);
               
        }else{
            $estado =  1;
            DB::update('update clientes set activo = ? where id_cliente = ?',[$estado,$id]);
        }
            return response()->json(['data'=>$estado]);
    }
}
