<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Compras extends Model{

   	protected $table = 'compras';

   	protected $primaryKey='id_compra';

	protected $fillable = [
     	'folio','comprobante','id_proveedor','activo'
    ];
}
