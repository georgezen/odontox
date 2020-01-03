<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Trabajadores
 * @package App\Models
 * @version June 21, 2019, 6:46 am UTC
 *
 * @property string nombre
 * @property string apellido_pat
 * @property string apellido_mat
 * @property string fecha_nac
 * @property string foto
 * @property string huella_digital
 * @property string activo
 */
class Trabajadores extends Model
{
    use SoftDeletes;

    public $table = 'trabajadores';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'nombre',
        'apellido_pat',
        'apellido_mat',
        'fecha_nac',
        'foto',
        'huella_digital',
        'activo'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'nombre' => 'string',
        'apellido_pat' => 'string',
        'apellido_mat' => 'string',
        'fecha_nac' => 'date',
        'foto' => 'string',
        'huella_digital' => 'string',
        'activo' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
       
    ];

    
}
