<?php

namespace App\Repositories;

use App\Models\Sucursales;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class SucursalesRepository
 * @package App\Repositories
 * @version June 20, 2019, 5:42 am UTC
 *
 * @method Sucursales findWithoutFail($id, $columns = ['*'])
 * @method Sucursales find($id, $columns = ['*'])
 * @method Sucursales first($columns = ['*'])
*/
class SucursalesRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'nombre'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Sucursales::class;
    }
}
