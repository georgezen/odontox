<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateSucursalesAPIRequest;
use App\Http\Requests\API\UpdateSucursalesAPIRequest;
use App\Models\Sucursales;
use App\Repositories\SucursalesRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class SucursalesController
 * @package App\Http\Controllers\API
 */

class SucursalesAPIController extends AppBaseController
{
    /** @var  SucursalesRepository */
    private $sucursalesRepository;

    public function __construct(SucursalesRepository $sucursalesRepo)
    {
        $this->sucursalesRepository = $sucursalesRepo;
    }

    /**
     * Display a listing of the Sucursales.
     * GET|HEAD /sucursales
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->sucursalesRepository->pushCriteria(new RequestCriteria($request));
        $this->sucursalesRepository->pushCriteria(new LimitOffsetCriteria($request));
        $sucursales = $this->sucursalesRepository->all();

        return $this->sendResponse($sucursales->toArray(), 'Sucursales retrieved successfully');
    }

    /**
     * Store a newly created Sucursales in storage.
     * POST /sucursales
     *
     * @param CreateSucursalesAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateSucursalesAPIRequest $request)
    {
        $input = $request->all();

        $sucursales = $this->sucursalesRepository->create($input);

        return $this->sendResponse($sucursales->toArray(), 'Sucursales saved successfully');
    }

    /**
     * Display the specified Sucursales.
     * GET|HEAD /sucursales/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Sucursales $sucursales */
        $sucursales = $this->sucursalesRepository->findWithoutFail($id);

        if (empty($sucursales)) {
            return $this->sendError('Sucursales not found');
        }

        return $this->sendResponse($sucursales->toArray(), 'Sucursales retrieved successfully');
    }

    /**
     * Update the specified Sucursales in storage.
     * PUT/PATCH /sucursales/{id}
     *
     * @param  int $id
     * @param UpdateSucursalesAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateSucursalesAPIRequest $request)
    {
        $input = $request->all();

        /** @var Sucursales $sucursales */
        $sucursales = $this->sucursalesRepository->findWithoutFail($id);

        if (empty($sucursales)) {
            return $this->sendError('Sucursales not found');
        }

        $sucursales = $this->sucursalesRepository->update($input, $id);

        return $this->sendResponse($sucursales->toArray(), 'Sucursales updated successfully');
    }

    /**
     * Remove the specified Sucursales from storage.
     * DELETE /sucursales/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Sucursales $sucursales */
        $sucursales = $this->sucursalesRepository->findWithoutFail($id);

        if (empty($sucursales)) {
            return $this->sendError('Sucursales not found');
        }

        $sucursales->delete();

        return $this->sendResponse($id, 'Sucursales deleted successfully');
    }
}
