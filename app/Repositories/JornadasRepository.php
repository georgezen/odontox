<?php

namespace App\Repositories;

use App\Models\Jornadas;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class JornadasRepository
 * @package App\Repositories
 * @version June 20, 2019, 5:33 am UTC
 *
 * @method Jornadas findWithoutFail($id, $columns = ['*'])
 * @method Jornadas find($id, $columns = ['*'])
 * @method Jornadas first($columns = ['*'])
*/
class JornadasRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'hora_inicio',
        'hora_fin',
        'descripcion'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Jornadas::class;
    }
}
