<?php

namespace App\Exports;

use App\Models\Modalidad;
use App\Models\Egresado;
use App\Models\Academico;
use App\Models\EgresadoAcademico;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

use DB;


class EgresadosExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    
    public function __construct($ciclo1, $pe)
    {
        $this->ciclo= $ciclo1;
        $this->pe= $pe;
    }
    
    public function view(): View
    {

        if( $this->ciclo == "todos" AND  $this->pe == "todos" )
        {
            $user = DB::table('academicos')
                        ->join('egresados', 'egresados.id', '=', 'academicos.egresado_id')
                        ->join('modalidades', 'modalidades.id', '=', 'academicos.modalidad_id')
                        ->selectRaw('egresados.id, academicos.matricula, academicos.licenciatura, egresados.apellidos, egresados.nombre, 
                                    egresados.sexo, egresados.edad, modalidades.modalidad, egresados.email, egresados.telefono, 
                                    egresados.created_at')
                        ->orderBy('egresados.created_at','DESC')
                        ->get();

        }
        else if( $this->ciclo != "todos" AND  $this->pe != "todos" )
        {
            $user = DB::table('academicos')
            ->join('egresados', 'egresados.id', '=', 'academicos.egresado_id')
            ->join('modalidades', 'modalidades.id', '=', 'academicos.modalidad_id')
            ->selectRaw('egresados.id, academicos.matricula, academicos.licenciatura, egresados.apellidos, egresados.nombre, 
                        egresados.sexo, egresados.edad, modalidades.modalidad, egresados.email, egresados.telefono, 
                        egresados.created_at')
            ->Where(DB::raw('left(academicos.matricula,2)') , '=' ,  $this->ciclo)
            ->Where('academicos.licenciatura' , '=' ,  $this->pe)

            ->orderBy('egresados.created_at','DESC')
            ->get();
        }
        else
        {
            $user = DB::table('academicos')
            ->join('egresados', 'egresados.id', '=', 'academicos.egresado_id')
            ->join('modalidades', 'modalidades.id', '=', 'academicos.modalidad_id')
            ->selectRaw('egresados.id, academicos.matricula, academicos.licenciatura, egresados.apellidos, egresados.nombre, 
                        egresados.sexo, egresados.edad, modalidades.modalidad, egresados.email, egresados.telefono, 
                        egresados.created_at')
            ->Where(DB::raw('left(academicos.matricula,2)') , '=' ,  $this->ciclo)
            ->orWhere('academicos.licenciatura' , '=' ,  $this->pe)

            ->orderBy('egresados.created_at','DESC')
            ->get();
        }

        return view('admin-excel-egresado',compact('user'));
    }
}
