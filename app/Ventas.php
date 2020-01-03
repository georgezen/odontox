<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ventas extends Model
{
    protected $table = 'ventas';

   	protected $primaryKey='id_venta';

	protected $fillable = [
     	'id_cliente','tipo_comprobante','folio','activo'
    ];
}
