<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Egresado extends Model
{
    use HasFactory;
    protected $table = 'egresados';
    protected $fillable = ['nombre', 'apellidos', 'sexo', 'edad', 'email', 'telefono', 'create_at', 'update_at'];

     //Un EGRESADO se asocia con un dato ACADEMICO
     public function academico()
     {
         return $this->hasOne('App\Models\Academico');
     }

     
}
