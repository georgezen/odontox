<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateTipo_marcadorRequest;
use App\Http\Requests\UpdateTipo_marcadorRequest;
use App\Repositories\Tipo_marcadorRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class Tipo_marcadorController extends AppBaseController
{
    /** @var  Tipo_marcadorRepository */
    private $tipoMarcadorRepository;

    public function __construct(Tipo_marcadorRepository $tipoMarcadorRepo)
    {
        $this->tipoMarcadorRepository = $tipoMarcadorRepo;
    }

    /**
     * Display a listing of the Tipo_marcador.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->tipoMarcadorRepository->pushCriteria(new RequestCriteria($request));
        $tipoMarcadors = $this->tipoMarcadorRepository->all();

        return view('tipo_marcadors.index')
            ->with('tipoMarcadors', $tipoMarcadors);
    }

    /**
     * Show the form for creating a new Tipo_marcador.
     *
     * @return Response
     */
    public function create()
    {
        return view('tipo_marcadors.create');
    }

    /**
     * Store a newly created Tipo_marcador in storage.
     *
     * @param CreateTipo_marcadorRequest $request
     *
     * @return Response
     */
    public function store(CreateTipo_marcadorRequest $request)
    {
        $input = $request->all();

        $tipoMarcador = $this->tipoMarcadorRepository->create($input);

        Flash::success('Tipo de jornada creada con exito.');

        return redirect(route('tipoMarcadors.index'));
    }

    /**
     * Display the specified Tipo_marcador.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $tipoMarcador = $this->tipoMarcadorRepository->findWithoutFail($id);

        if (empty($tipoMarcador)) {
            Flash::error('Tipo Marcador not found');

            return redirect(route('tipoMarcadors.index'));
        }

        return view('tipo_marcadors.show')->with('tipoMarcador', $tipoMarcador);
    }

    /**
     * Show the form for editing the specified Tipo_marcador.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $tipoMarcador = $this->tipoMarcadorRepository->findWithoutFail($id);

        if (empty($tipoMarcador)) {
            Flash::error('Tipo Marcador not found');

            return redirect(route('tipoMarcadors.index'));
        }

        return view('tipo_marcadors.edit')->with('tipoMarcador', $tipoMarcador);
    }

    /**
     * Update the specified Tipo_marcador in storage.
     *
     * @param  int              $id
     * @param UpdateTipo_marcadorRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateTipo_marcadorRequest $request)
    {
        $tipoMarcador = $this->tipoMarcadorRepository->findWithoutFail($id);

        if (empty($tipoMarcador)) {
            Flash::error('Tipo Marcador not found');

            return redirect(route('tipoMarcadors.index'));
        }

        $tipoMarcador = $this->tipoMarcadorRepository->update($request->all(), $id);

        Flash::success('Tipo de jornada editada con exito.');

        return redirect(route('tipoMarcadors.index'));
    }

    /**
     * Remove the specified Tipo_marcador from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $tipoMarcador = $this->tipoMarcadorRepository->findWithoutFail($id);

        if (empty($tipoMarcador)) {
            Flash::error('Tipo Marcador not found');

            return redirect(route('tipoMarcadors.index'));
        }

        $this->tipoMarcadorRepository->delete($id);

        Flash::success('Tipo de jornada borrada con exito.');

        return redirect(route('tipoMarcadors.index'));
    }
}
