<?php

namespace App\Repositories;

use App\Models\roles;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class rolesRepository
 * @package App\Repositories
 * @version July 9, 2019, 11:42 pm UTC
 *
 * @method roles findWithoutFail($id, $columns = ['*'])
 * @method roles find($id, $columns = ['*'])
 * @method roles first($columns = ['*'])
*/
class rolesRepository extends BaseRepository
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
        return roles::class;
    }
}
