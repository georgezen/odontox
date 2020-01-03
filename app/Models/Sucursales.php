<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Sucursales
 * @package App\Models
 * @version June 20, 2019, 5:42 am UTC
 *
 * @property string nombre
 */
class Sucursales extends Model
{
    use SoftDeletes;

    public $table = 'sucursales';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'nombre',
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
        'activo' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'nombre' => 'required|min:9'
    ];

    
}
