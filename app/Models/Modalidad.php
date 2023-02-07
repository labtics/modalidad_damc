<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Modalidad extends Model
{
    use HasFactory;

    protected $table = 'modalidades';
    protected $fillable = ['modalidad', 'descripcion'];

    //Una modalidad se asocia con muchos datos ACADEMICOS
    public function academicos()
    {
        return $this->hasMany('App\Models\Academico');
    }
}
