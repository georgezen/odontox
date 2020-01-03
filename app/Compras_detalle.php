<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Compras_detalle extends Model
{
    	protected $table = 'compra_detalle';

   	protected $primaryKey='id_compra_detalle';

	protected $fillable = [
     	'id_compra','id_producto','cantidad','precio_compra','precio_venta'
    ];
}
