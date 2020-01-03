<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Trabajador extends Model
{

	protected $table = 'Trabajadores';

	protected $fillable = [
     	'nombre','apellido_pat','apellido_mat','fecha_nac','foto','huella_digital','active'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'created_at', 'updated_at',
    ];
    //

    protected $dateFormat = 'Ymd H:i:s';
}
