<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

//El modelo Egresado se relacionará con el modelo Académico con una cardinalidad de 1 a 1
//Es decir: Un Egresado se relaciona con un dato Académico

class Egresado extends Model
{

    use HasFactory;
    protected $table = 'egresados'; // Se le indica a Laravel la tabla a la cual se accederá
    protected $fillable = ['nombre', 'apellidos', 'sexo', 'edad', 'email', 'telefono', 'create_at', 'update_at']; //Se le indica a Laravel que campos estarán visibles para acceder.

     //Un EGRESADO se asocia con un dato ACADEMICO
     public function academico() //El nombre de la función debe ser en singular ya que la relación es de 1 a 1
     {
         return $this->hasOne('App\Models\Academico'); // Se le indica a la relación donde se encuentra el modelo "Academico"
     }

     
}
