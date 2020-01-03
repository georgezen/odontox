<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ventas_detalle extends Model
{
    protected $table = 'detalle_venta';

   	protected $primaryKey='id_detalle_venta';

	protected $fillable = [
     	'id_detalle_venta','id_venta','id_producto','cantidad','precio_venta','descuento'
    ];
}
