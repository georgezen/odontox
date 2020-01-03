<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Productos;
use Illuminate\Support\Facades\DB;


class Productos_controller extends Controller
{

    public function __construct()
    {

        $this->middleware('auth');
    }

    public function index(Request $request){
      
        $productos = DB::table('productos')
        ->paginate(10);
        

         //codigo para sacar el total de registros           
        $count = Productos::count();

        return view('productos.index')
        ->with('count',$count)
        ->with('productos',$productos);
    }

    public function loadPage(Request $request)
    {
        if ($request->ajax()) {
         $productos = DB::table('productos')->paginate(10);

         $count = Productos::count();
         
         return view('productos.table')
         ->with('count',$count)
         ->with('productos',$productos)->render();
     }
 }
    //Funcion de filtrado especifico por codigo, nombre o descripcion
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

        
        return view('productos.table')->with('productos',$data)
        ->with('count',$total_registros)
        ->render();
    }
}

public function store(Request $request)
{
 if ($request->ajax()) {
            # code...
    $producto = new Productos;


    $datos = request()->validate([
       'codigo'=>'required',
       'nombre'=>'required',
       'descripcion'=>'required'
       
       
       

   ], [
    'codigo.required' => 'El campo  codigo es requerido',
    'nombre.required' => 'El campo  nombre es requerido',
    'descripcion.required' => 'El campo  descripcion es requerido'
    

]);
    
    $producto->codigo = $request->codigo;
    $producto->nombre = $request->nombre;
    $producto->descripcion = $request->descripcion;
    
    $producto->estado = 1;
    
    $producto->save();
    return response()->json(['data'=>$request->all(),'id_producto'=>$producto->id_producto]);
}
}

//funcion para cargar id de producto y la modal para cargar imagen
public function load_id(Request $request){

   if ($request->ajax()) {

    $id_producto = $request->input('id_producto');

    $producto = Productos::find($id_producto);
    return response()->json(['data'=>$request->all(),'id_producto'=>$producto->id_producto]);
}
}
//funcion para cargar la imagen
public function upload_image(Request $request){
    
    if ($request->ajax()) {
        $image = $request->file('imagen');
        $id_product = $request->input('id_product');

            //Se extrae el nombre del archivo cargado
        $new_name = rand().'.'.$image->getClientOriginalExtension();
            //Se guarda en la carpeta indicada en public_path el archivo cargado
        $image->move(public_path('/imagenes/'),$new_name);

        $producto = Productos::find($id_product);
        $producto->imagen = $new_name;
        $producto->save();
        return response()->json(['data'=>$new_name,'id_producto'=>$id_product]);
        
    }


}


public function edit_producto(Request $request){
    
 if ($request->ajax()) {

    $id = $request->input('id_producto');
    $productos = Productos::find($id);
    return response()->json(['data'=>$productos,'id_producto'=>$productos->id_producto]);
}
}


public function update_producto(Request $request){
 
   if ($request->ajax()) {

     

    $id = $request->input('id_pro_edit');
    $producto = Productos::find($id);
    $producto->codigo = $request->edit_codigo;
    $producto->nombre = $request->edit_descripcion;
    $producto->descripcion = $request->edit_descripcion;
    
    $producto->save();

    return response()->json(['data'=>$producto,'id_producto'=>$producto->id_producto]);
}

}


public function off_producto(Request $request){
    $id = $request->input('id_delete');
    $producto = Productos::where('id_producto','=',$id)->firstOrFail();
    if ($producto->estado == 1) {
        $estado =  0;
        DB::update('update productos set estado = ? where id_producto = ?',[$estado,$id]);
        return response()->json(['data'=>$estado]);   
    }else{
        $estado =  1;
        DB::update('update productos set estado = ? where id_producto = ?',[$estado,$id]);
        return response()->json(['data'=>$estado]);
    }
    
}
}
