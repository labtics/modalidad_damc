<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActividadLaboral extends Model
{
    use HasFactory;

    protected $table = 'actividadesLaborales';
    protected $fillable = ['id', 'egresado_id', 'actividad_laboral', 'nombre_institución'];
    protected $guarded = ['created_at', 'updated_at'];

    //Un ACTIVIDAD LABORAL se asocia con un EGRESADO
    public function egresado()
    {
        return $this->hasOne('App\Models\Egresado');
    }
}
