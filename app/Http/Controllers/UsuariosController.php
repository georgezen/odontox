<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\DB;
use App\Models\Trabajadores;
use App\Http\Controllers\Validator;
use Flash;
use App\Models\roles;
use App\Models\Sucursales;

class UsuariosController extends Controller{


    public function __construct(){


        $this->middleware('auth');
    }

    public function index(){

        $users = DB::table('users as us')
        ->join('sucursales as suc','us.id_sucursal','=','suc.id')
        ->select('us.id','us.name','us.email','us.activo','suc.nombre')
        ->get();

        


        return view('auth.lista_usuarios',['users' => $users]);
    }

    public function create(){
        $trabajadors = DB::table('trabajadores')
        ->select( 'id',DB::raw('concat(nombre," ",apellido_pat," ",apellido_mat) as fullname'))
        ->where('activo','=','1')
        ->get();

        $roles = DB::table('roles')
        ->select( 'id','descripcion')
        ->where('activo','=','1')
        ->get();

         $sucursales = DB::table('sucursales')
        ->select( 'id','nombre')
        ->where('activo','=','1')
        ->get();

        return view('auth.create_user',['trabajadors' => $trabajadors,'roles' => $roles,'sucursales'=>$sucursales]);
    }


    public function store(Request $request){

        $user = new User;
        $datos = request()->validate([
            'name' => ['required','string'],
            'email' => ['required','unique:users,email','email'],
            'password' => ['required','min:8'],
            'trabajadors' => ['unique:users,id_trabajador']

        ], [
          'name.required' => 'El campo  nombre es requerido',
          'email.required' => 'El campo email es requerido',
          'email.unique' => 'El correo ya esta registrado',
          'password.required' => 'El campo contraseña es requerido',
          'password.min' => 'La contraseña ocupa 8 caracteres minimo',
          'trabajadors.unique' => 'Eliga otro trabajador'
      ]);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->id_trabajador = $request->trabajadors;
        $user->id_rol = $request->rols;
        $user->id_sucursal = $request->sucursal;
        $user->activo = 1;

        $user->save();
        return redirect(route('usuarios.index'));

    }

    public function edit($id){

        $users = User::where('id','=',$id)->firstOrFail();

        $trabajadors = DB::table('trabajadores')
        ->select( 'id',DB::raw('concat(nombre," ",apellido_pat," ",apellido_mat) as fullname'))
        ->where('activo','=','1')
        ->get();        

        $roles = DB::table('roles')
        ->select( 'id','descripcion')
        ->where('activo','=','1')
        ->get();

        $sucursales = DB::table('sucursales')
        ->select( 'id','nombre')
        ->where('activo','=','1')
        ->get();

        return view('auth.edit_user')
        ->with('users',$users)
        ->with('trabajadors',$trabajadors)
        ->with('roles',$roles)
        ->with('sucursales',$sucursales);

    }


    public function update(Request $request, $id){

        $datos = request()->validate([
            'name' => ['required',],
            'email' => ['required','email'],
            'trabajadors' => ['unique:users,id_trabajador']

        ], [
            'name.required' => 'El campo  nombre es requerido',
            'email.required' => 'El campo email es requerido',
            'email.email' => 'Ingrese un formato valido de correo',
            'trabajadors.unique' => 'Eliga otro trabajador'
        ]);

        if ($request->input('password') == "") {
            $name = $request->input('name');
            $email = $request->input('email');
            $id_trabajador = $request->input('trabajadors');
            $id_rol = $request->input('rols');
            $id_sucursal = $request->input('sucursal');
            DB::update('update users set name = ?,email = ?,id_trabajador = ?,id_rol = ?,id_sucursal = ? where id = ?',[$name,$email,$id_trabajador,$id_rol,$id_sucursal,$id]);
        }else{
            $name = $request->input('name');
            $email = $request->input('email');
            $id_trabajador = $request->input('trabajadors');
            $id_rol = $request->input('rols');
            $id_sucursal = $request->input('sucursal');
            $password = bcrypt($request->input('password'));
            DB::update('update users set name = ?,email = ?,id_trabajador = ?,id_rol = ?,password = ?,id_sucursal = ? where id = ?',[$name,$email,$id_trabajador,$id_rol,$id_sucursal,$password,$id]);

        }
        
        Flash::success('Usuario actualizado con exito.');
        
        return redirect(route('usuarios.index'));
    }


    public function destroy($id){

        $user = User::where('id','=',$id)->firstOrFail();
        if ($user->activo == 1) {
            $activo =  0;
            DB::update('update users set activo = ? where id = ?',[$activo,$id]);
            
        }else{
            $activo =  1;
            DB::update('update users set activo = ? where id = ?',[$activo,$id]);
        }
        
        return redirect(route('usuarios.index'));
    }
}
