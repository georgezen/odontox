<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Tipo_marcador
 * @package App\Models
 * @version June 21, 2019, 6:54 am UTC
 *
 * @property string descripcion
 */
class Tipo_marcador extends Model
{
    use SoftDeletes;

    public $table = 'tipo_marcadors';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'descripcion'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'descripcion' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];

    
}
