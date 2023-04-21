<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

//El modelo Academico se relacionará con dos modelos: 
//+ modelo Egresado con una cardinalidad de 1 a 1. Es decir: Un dato Academico se relaciona con un Egresado
//+ modelo Modalidad con una cardinalidad de 1 a 1. Es decir: Un dato Academico se relaciona con una  Académico

//NOTA: En el caso de una relación 1 a m, se debe hacer la relación inversa y si es así se utiliza "belongsTo"

class Academico extends Model
{
    use HasFactory;

    protected $table = 'academicos';
    protected $fillable = ['egresado_id', 'modalidad_id', 'matricula', 'licenciatura', 'promedio'];

    //Un dato ACADEMICO se asocia con un EGRESADO
    public function egresado()
    {
        return $this->hasOne('App\Models\Egresado');
    }

    //Un dato ACADEMICO le pertenece una MODALIDAD
    public function modalidad()
    {
        return $this->belongsTo('App\Models\Modalidad'); 
    }
}
