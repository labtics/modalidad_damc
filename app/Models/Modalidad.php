<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

//El modelo Modalidad se relacionará con el modelo Académico con una cardinalidad de 1 a m
//Es decir: Una Modalidad se relaciona con muchos datos Académicos, es decir una Modalidad se puede repetir en muchos datos Académicos

class Modalidad extends Model
{
    use HasFactory;

    protected $table = 'modalidades';
    protected $fillable = ['id', 'modalidad', 'descripcion'];

    //Una modalidad se asocia con muchos datos ACADEMICOS
    public function academicos() //El nombre de la función debe ser en plurar (Recuerda que la relación es de 1 a m)
    {
        return $this->hasMany('App\Models\Academico'); // Se le indica a la relación donde se encuentra el modelo "Academico"
    }
}
