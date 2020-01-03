<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Proveedores extends Model
{

	protected $table = 'proveedores';

	protected $primaryKey='id_proveedor';

   	protected $fillable = [
     	'nombre','ape_paterno','ape_materno','telefono','calle','colonia','num_exterior','municipio','estado','pais','activo'
    ];

    protected $hidden = [
        'created_at', 'updated_at',
    ];
}
