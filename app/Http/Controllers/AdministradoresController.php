<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Modalidad;

use DB;

class AdministradoresController extends Controller
{

    public function create()
    {
        // La función create me permite mostrar la página inicial del sitio web
        // Al mismo tiempo a la vista se le pasa una variable denominada modalidades
        // la cual contiene los campos de la tabla Modalidades.


    }

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

    public function edit($id)
    {
        
        $modalidades = Modalidad::all();

        $user = DB::table('academicos')
        ->join('egresados', 'egresados.id', '=', 'academicos.egresado_id')
        ->join('modalidades', 'modalidades.id', '=', 'academicos.modalidad_id')
        ->select('egresados.nombre','egresados.apellidos','modalidades.modalidad')
        ->where('egresados.id','=', $id)
        ->first();

        return view('editar', compact('user','modalidades'));  
    }
}