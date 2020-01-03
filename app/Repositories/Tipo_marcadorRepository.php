<?php

namespace App\Repositories;

use App\Models\Tipo_marcador;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class Tipo_marcadorRepository
 * @package App\Repositories
 * @version June 21, 2019, 6:54 am UTC
 *
 * @method Tipo_marcador findWithoutFail($id, $columns = ['*'])
 * @method Tipo_marcador find($id, $columns = ['*'])
 * @method Tipo_marcador first($columns = ['*'])
*/
class Tipo_marcadorRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'descripcion'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Tipo_marcador::class;
    }
}
