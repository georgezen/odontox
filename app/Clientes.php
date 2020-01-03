<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Clientes extends Model
{

	protected $table = 'clientes';

   	protected $primaryKey='id_cliente';

	protected $fillable = [
     	'nombre','ape_paterno','ape_materno','edad','telefono','calle','num_exterior','colonia','ciudad','estado','pais','activo'
    ];

}
