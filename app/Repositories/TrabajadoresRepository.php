<?php

namespace App\Repositories;

use App\Models\Trabajadores;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class TrabajadoresRepository
 * @package App\Repositories
 * @version June 21, 2019, 6:46 am UTC
 *
 * @method Trabajadores findWithoutFail($id, $columns = ['*'])
 * @method Trabajadores find($id, $columns = ['*'])
 * @method Trabajadores first($columns = ['*'])
*/
class TrabajadoresRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'nombre',
        'apellido_pat',
        'apellido_mat',
        'fecha_nac',
        'foto',
        'huella_digital',
        'activo'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Trabajadores::class;
    }
}
