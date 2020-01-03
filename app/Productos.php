<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Productos extends Model
{
    protected $table = 'productos';
    
    protected $primaryKey='id_producto';

    protected $dates = ['deleted_at'];


    public $fillable = [
    	'codigo',
    	'nombre',
    	'descripcion',
    	'stock',
    	'imagen',
    	'estado'
        
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        
    ];

    //Plantilla de consulta sql (scope)
    public function scopeCodigo($query,$codigo){
    
        if (trim($codigo) ) {
            return $query->where('codigo' ,'LIKE',"%$codigo%");
        }
    }

   public function scopeNombre($query,$nombre){
        if (trim($nombre)) {
            return $query->where('nombre' ,'LIKE',"%$nombre%");
        }
        
    }

   /*  public function scopeDescripcion($query,$descripcion){
        if (trim($descripcion)) {
            return $query->where('descripcion' ,'LIKE',"%$descripcion%");
        }
        
    }   */ 

   
}
