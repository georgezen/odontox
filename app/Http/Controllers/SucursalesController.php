<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateSucursalesRequest;
use App\Http\Requests\UpdateSucursalesRequest;
use App\Repositories\SucursalesRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use App\Models\Sucursales;
use Illuminate\Support\Facades\DB;

class SucursalesController extends AppBaseController
{
    /** @var  SucursalesRepository */
    private $sucursalesRepository;

    public function __construct(SucursalesRepository $sucursalesRepo)
    {
        $this->sucursalesRepository = $sucursalesRepo;
        $this->middleware('auth');
    }


    public function index(Request $request)
    {
        $this->sucursalesRepository->pushCriteria(new RequestCriteria($request));
        $sucursales = $this->sucursalesRepository->all();

        return view('sucursales.index')
            ->with('sucursales', $sucursales);
    }

    public function create()
    {
        return view('sucursales.create');
    }


    public function store(CreateSucursalesRequest $request)
    {
        $input = $request->all();

        $sucursales = $this->sucursalesRepository->create($input);

        Flash::success('Sucursal añadida con exito.');

         return redirect(route('sucursales.index'));

    }


    public function edit(Request $request){

        $id = $request->input('id_sucursal');
        $sucursales = Sucursales::find($id);     
        
       return response()->json(['data'=>$sucursales]); 
    }


    public function update(Request $request){
         if ($request->ajax()) {
            $id = $request->input('id_sucursal_update');
            $sucursal = Sucursales::find($id);
            $sucursal->nombre = $request->upd_suc;
            $sucursal->save();

            return response()->json(['data'=>$sucursal]);
        }
       
    }


    public function destroy(Request $request){
        $id = $request->input('id_delete');
        $sucursal = Sucursales::where('id','=',$id)->firstOrFail();
        if ($sucursal->activo == 1) {
            $estado =  0;
            DB::update('update sucursales set activo = ? where id = ?',[$estado,$id]);
            return response()->json(['data'=>$estado]);   
        }else{
            $estado =  1;
            DB::update('update sucursales set activo = ? where id = ?',[$estado,$id]);
            return response()->json(['data'=>$estado]);
        }
        
    }
}
