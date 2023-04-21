<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comentario extends Model
{
    use HasFactory;

    protected $table = 'comentarios';
    protected $fillable = ['id', 'egresado_id', 'comentario', 'experiencia'];

    //Un COMENTARIO se asocia con un EGRESADO
    public function egresado()
    {
        return $this->hasOne('App\Models\Egresado');
    }
}
