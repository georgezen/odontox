<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreaterolesRequest;
use App\Http\Requests\UpdaterolesRequest;
use App\Repositories\rolesRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use App\Models\roles;
use Illuminate\Support\Facades\DB;

class rolesController extends AppBaseController
{
    
    private $rolesRepository;

    public function __construct(rolesRepository $rolesRepo)
    {
        $this->rolesRepository = $rolesRepo;
        $this->middleware('auth');
    }


    public function index()
    {

        return view('roles.index');

    }

    public function read_roles(){

        $roles = DB::table('roles')->get();
        
        return response()->json($roles);
    }

    public function create()
    {
        return view('roles.create');
    }

    public function store(Request $request){

        if ($request->ajax()) {
            # code...
            $rol = new roles;
            $datos = request()->validate([
                'descripcion' => ['required'],


            ], [
              'descripcion.required' => 'El campo  descripcion es requerido',

          ]);
            $rol->descripcion = $request->descripcion;
            $rol->activo == 1;
            $rol->save();
            return response()->json(['data'=>$request->all(),'id'=>$rol->id]);
        }
    }

    public function show($id)
    {
        $roles = $this->rolesRepository->findWithoutFail($id);

        if (empty($roles)) {
            Flash::error('Roles not found');

            return redirect(route('roles.index'));
        }

        return view('roles.show')->with('roles', $roles);
    }


    public function edit(Request $request)
    {
        if ($request->ajax()) {

            $id = $request->input('id_rol');
            $rol = roles::find($id);
            return response()->json(['data'=>$rol,'id'=>$rol->id]);
        }
        
    }

    public function update(Request $request)
    {

        if ($request->ajax()) {
            $id = $request->input('id_rol_edit');
            $rol = roles::find($id);
            $rol->descripcion = $request->descripcion_edit;
            $rol->save();

            return response()->json(['data'=>$rol,'id'=>$rol->id]);
        }

        
    }

    public function destroy(Request $request){
         $id = $request->input('id_rol');
        $rol = roles::where('id','=',$id)->firstOrFail();
        if ($rol->activo == 1) {
            $estado =  0;
            DB::update('update roles set activo = ? where id = ?',[$estado,$id]);
            return response()->json(['data'=>$estado]);   
        }else{
            $estado =  1;
            DB::update('update roles set activo = ? where id = ?',[$estado,$id]);
            return response()->json(['data'=>$estado]);
        }
   }
       


}
