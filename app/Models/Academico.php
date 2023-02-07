<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Academico extends Model
{
    use HasFactory;

    protected $table = 'academicos';
    protected $fillable = ['egresado_id', 'modalidad_id', 'matricula', 'licenciatura'];

    //Un dato ACADEMICO se asocia con un EGRESADO
    public function egresado()
    {
        return $this->hasOne('App\Models\Egresado');
    }


    //Un dato ACADEMICO le pertenece una MODALIDAD
    public function modalidad()
    {
        return $this->belongsTo('App\Models\Modalidad','id'); 
        //El segundo argumento de la función  "id" le indica al ORM que utilice la clave
        //primaria que estoy definiendo, ya que si no lo especifico, Eloquent intentara buscar
        //en la tabla "modalidad" un campo denominado "academico_id". Recordar que entre la 
        //tabla "modalidades" y "academicos".

    }
}
