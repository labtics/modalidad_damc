<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class AdministradoresController extends Controller
{
    public function buscar_egresado(Request $request)
    {
        $buscar = $request->input('name');
    
        $user = DB::table('egresados')
            ->join('academicos', 'egresados.id', '=', 'academicos.egresado_id')
            ->select('egresados.id','academicos.matricula','academicos.licenciatura', 'egresados.nombre', 'egresados.apellidos', 'egresados.created_at')
            ->where('egresados.nombre','LIKE','%' . $buscar . '%')
            ->orWhere('egresados.apellidos','LIKE','%' . $buscar . '%')
            ->orWhere('academicos.matricula', '=', $buscar )
            ->orWhere(DB::raw('concat(egresados.nombre," ",egresados.apellidos)') , 'LIKE' , '%'.$buscar.'%')
            ->orderBy('egresados.apellidos')
            ->paginate(10);

            return view('panel', ['user' => $user]);
    }
}