<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Jornadas
 * @package App\Models
 * @version June 20, 2019, 5:33 am UTC
 *
 * @property string hora_inicio
 * @property string hora_fin
 * @property string descripcion
 */
class Jornadas extends Model
{
    use SoftDeletes;

    public $table = 'jornadas';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'hora_inicio',
        'hora_fin',
        'descripcion'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'hora_inicio' => 'time',
        'hora_fin' => 'time',
        'descripcion' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'descripcion' => 'required'
    ];

    
}
