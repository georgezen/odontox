<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PresentacionProducto extends Model
{
    protected $table = 'presentacion';
    
    protected $primaryKey='id_presentacion';

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
        
    ];

    /**
     * Validation rules
     *
     * @var array
     */
}
