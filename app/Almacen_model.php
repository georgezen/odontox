<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Almacen_model extends Model{

    protected $table = 'productos';

    protected $primaryKey='id_producto';

    protected $dates = ['deleted_at'];


}
