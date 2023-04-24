<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Modalidad;
use App\Models\Egresado;
use App\Models\Academico;
use App\Exports\EgresadosExport;
use Maatwebsite\Excel\Facades\Excel;

use DB;

class AdministradoresController extends Controller
{
    
    public $cicloExportar;


    public function create()
    {
        // La función create me permite mostrar la página inicial del sitio web
        // Al mismo tiempo a la vista se le pasa una variable denominada modalidades
        // la cual contiene los campos de la tabla Modalidades.


    }

    public function buscarEgresado(Request $request)
    {
        $buscar = $request->input('name');
    
        $user = DB::table('egresados')
            ->join('academicos', 'egresados.id', '=', 'academicos.egresado_id')
            ->select('egresados.id','academicos.matricula','academicos.licenciatura', 'egresados.nombre', 'egresados.apellidos', 'egresados.email','egresados.telefono', 'egresados.created_at')
            ->where('egresados.nombre','LIKE','%' . $buscar . '%')
            ->orWhere('egresados.apellidos','LIKE','%' . $buscar . '%')
            ->orWhere('academicos.matricula', '=', $buscar )
            ->orWhere(DB::raw('concat(egresados.nombre," ",egresados.apellidos)') , 'LIKE' , '%'.$buscar.'%')
            ->orderBy('egresados.created_at','DESC')
            ->paginate(20);

            return view('admin-buscar-egresado', ['user' => $user]);
    }

    public function edit($id)
    {
        
        $modalidades = Modalidad::all();

        $user = DB::table('academicos')
        ->join('egresados', 'egresados.id', '=', 'academicos.egresado_id')
        ->join('modalidades', 'modalidades.id', '=', 'academicos.modalidad_id')
        ->select('egresados.id','egresados.nombre','egresados.apellidos','modalidades.modalidad')
        ->where('egresados.id','=', $id)
        ->first();

        return view('admin-editar-egresado', compact('user','modalidades'));  
    }

    public function update(Request $request, $id)
    {
       
        Egresado::where('id', $id)->update(['nombre' => $request->input('nombre')]);
        Egresado::where('id', $id)->update(['apellidos' => $request->input('apellidos')]);
        Academico::where('egresado_id', $id)->update(['modalidad_id' => $request->input('modalidad_id')]);
        
        return redirect()->route('modalidad.edit', $id)->with('success', 'Los cambios se realizaron correctamente');

    }

    public function estadistica()
    {
        
                //GRAFICO SOLICITUDES PROMEDIO POR MES

                            $meses = DB::table('egresados')
                            ->selectRaw('FIELD(MONTH(created_at), 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12) AS Mes, (COUNT(created_at) / COUNT(DISTINCT YEAR(created_at)) ) as total' )
                            ->groupBy('Mes')
                            ->get();

                            $datosMes = [];
                            
                            foreach($meses as $mes)
                            {
                                $datosMeses[] = ['name'=>$mes->Mes, 'y'=>floatval($mes->total)];
                                
                            }

                            $jsonDataMes = json_encode($datosMeses);


                            //GRAFICO SOLICITUDES PROMEDIO POR DIA

                            $dias = DB::table('egresados')
                            ->selectRaw('DAYOFWEEK(created_at) AS Dias, (COUNT(created_at) / (COUNT(DISTINCT YEAR(created_at)) * 52.1429)) as total' )
                            ->groupBy('Dias')
                            ->get();

                            $datosDia = [];
                            
                            foreach($dias as $dia)
                            {
                                $datosDia[] = ['name'=>$dia->Dias, 'y'=>floatval($dia->total)];
                                
                            }

                            $jsonDataDia = json_encode($datosDia);

                //GRAFICO DE SOLICITUDES POR MODALIDAD DE TITULACIÓN
                
                                $modalidades = DB::table('academicos')
                                ->join('modalidades', 'modalidades.id', '=', 'academicos.modalidad_id')
                                ->selectRaw('modalidades.modalidad, count(academicos.modalidad_id) AS total')
                                ->groupBy('modalidades.modalidad')
                                ->orderBy('total', 'DESC')
                                ->get();
                
                                $datosModalidad = [];
                
                                foreach($modalidades as $modalidad)
                                {
                                    $datosModalidad[] = ['name'=>$modalidad->modalidad, 'y'=>floatval($modalidad->total)];
                                    
                                }
                
                                $jsonDataModalidad = json_encode($datosModalidad);
                
                //GRAFICO SOLICITUDES POR PROGRAMA EDUCATIVO
                
                                $modalidades_licenciaturas = DB::table('academicos')
                                ->join('egresados', 'egresados.id', '=', 'academicos.egresado_id')
                                ->selectRaw('CASE academicos.licenciatura 
                                            WHEN "lmc" THEN "Médico Cirujano"
                                            WHEN "le" THEN "Enfemería"
                                            WHEN "lrf" THEN "Rehabilitación Física"
                                            WHEN "lapyd" THEN "Atención. Pre. y Des."
                                            END AS pe, COUNT(egresados.created_at) AS total')
                                ->groupBy('academicos.licenciatura')
                                ->orderBy('total', 'ASC')
                                ->get();
                
                                $datosModalidad_Licenciatura = [];
                
                                foreach($modalidades_licenciaturas as $modalidad_licenciatura)
                                {
                                    $datosModalidad_Licenciatura[] = ['name'=>$modalidad_licenciatura->pe, 'y'=>floatval($modalidad_licenciatura->total)];
                                    
                                }
                
                                $jsonDataModalidad_Licenciatura = json_encode($datosModalidad_Licenciatura);
                 
                // Grafico por MODALIDAD Y PROMEDIO

                                $promedios = DB::table('academicos')
                                ->join('egresados', 'egresados.id', '=', 'academicos.egresado_id')
                                ->selectRaw('DISTINCT(academicos.modalidad_id) AS Modalidades, 
                                            COUNT(CASE WHEN academicos.promedio = 10 THEN 1 END) AS Diez, 
                                            COUNT(CASE WHEN academicos.promedio = 9 THEN 1 END) AS Nueve ,
                                            COUNT(CASE WHEN academicos.promedio = 8 THEN 1 END) AS Ocho,
                                            COUNT(CASE WHEN academicos.promedio = 7 THEN 1 END) AS Siete')
                                ->groupBy('Modalidades')
                                ->get();
                    
                                $datosPromedios = [];
                            
                                foreach($promedios as $promedio)
                                {
                                    $datosPromedio[] = ['diez'=>$promedio->Diez,'nueve'=>$promedio->Nueve,'ocho'=>$promedio->Ocho,'siete'=>$promedio->Siete];
                                    
                                }
                
                                $jsonDataPromedio = json_encode($datosPromedio);
                    
                // Grafico por estado civil

                                $estadosCiviles = DB::table('academicos')
                                ->join('egresados', 'egresados.id', '=', 'academicos.egresado_id')
                                ->selectRaw('CASE egresados.estado_civil 
                                            WHEN "soltero" THEN "Soltero"
                                            WHEN "casado" THEN "Casado"
                                            WHEN "separado" THEN "Separado"
                                            WHEN "viudo" THEN "Viudo"
                                            WHEN "union_libre" THEN "Unión Libre"
                                            END AS estado_civil, COUNT(egresados.estado_civil) AS total')
                                ->groupBy('egresados.estado_civil')
                                ->orderBy('total', 'ASC')
                                ->get();
                
                                $datosEstadoCivil = [];
                
                                foreach($estadosCiviles as $estadoCivil)
                                {
                                    $datosEstadoCivil[] = ['name'=>$estadoCivil->estado_civil, 'y'=>floatval($estadoCivil->total)];
                                    
                                }
                
                                $jsonDataEstadoCivil = json_encode($datosEstadoCivil);

                    //GRAFICO DE LICENCIATURAS Y ACTIVIDAD LABORAL

                                $actividadesLaborales = DB::table('academicos')
                                ->join('egresados', 'egresados.id', '=', 'academicos.egresado_id')
                                ->join('actividadesLaborales', 'actividadesLaborales.egresado_id', '=', 'academicos.egresado_id')
                                ->join('modalidades', 'modalidades.id', '=', 'academicos.modalidad_id')
                                ->selectRaw('modalidades.modalidad, COUNT(CASE WHEN actividadesLaborales.actividad_laboral = "si" THEN 1 END) AS total')
                                ->groupBy('modalidades.modalidad')
                                ->orderBy('total', 'DESC')
                                ->get();
                
                                $datosActividadLaboral = [];
                
                                foreach($actividadesLaborales as $actividadLaboral)
                                {
                                    $datosActividadLaboral[] = ['name'=>$actividadLaboral->modalidad, 'y'=>floatval($actividadLaboral->total)];
                                    
                                }
                
                                $jsonDataActividadLaboral = json_encode($datosActividadLaboral);
                    
                    //GRAFICO ACTIVIDAD LABORAL POR ESTADO CIVIL

                    $estadosCivilesActsLabs = DB::table('academicos')
                    ->join('egresados', 'egresados.id', '=', 'academicos.egresado_id')
                    ->join('actividadesLaborales', 'actividadesLaborales.egresado_id', '=', 'academicos.egresado_id')
                    ->selectRaw('actividadesLaborales.actividad_laboral, 
                                 COUNT(CASE WHEN egresados.estado_civil = "soltero" THEN 1 END) AS Soltero,
                                 COUNT(CASE WHEN egresados.estado_civil = "casado" THEN 1 END) AS Casado,
                                 COUNT(CASE WHEN egresados.estado_civil = "viudo" THEN 1 END) AS Viudo,
                                 COUNT(CASE WHEN egresados.estado_civil = "union_libre" THEN 1 END) AS Union_Libre,
                                 COUNT(CASE WHEN egresados.estado_civil = "separado" THEN 1 END) AS Separado
                                 ')
                    ->groupBy('actividadesLaborales.actividad_laboral')
                    ->get();
        
                    $datosEstadosCivilesActsLabs = [];
                
                    foreach($estadosCivilesActsLabs as $estadoCivilActLab)
                    {
                        $datosEstadosCivilesActsLabs[] = ['soltero'=>$estadoCivilActLab->Soltero,'casado'=>$estadoCivilActLab->Casado,'viudo'=>$estadoCivilActLab->Viudo,'union_libre'=>$estadoCivilActLab->Union_Libre,'separado'=>$estadoCivilActLab->Separado];
                        
                    }
    
                    $jsonEstadosCivilesActsLabs = json_encode($datosEstadosCivilesActsLabs);

               return view('admin-estadistica-egresado')->with(compact('jsonDataModalidad','jsonDataModalidad_Licenciatura','jsonDataMes','jsonDataDia','jsonDataPromedio', 'jsonDataEstadoCivil', 'jsonDataActividadLaboral', 'jsonEstadosCivilesActsLabs'));

    }

    public function estadisticaDinamica(Request $request)
    {
                
        $pe = $request->input('pe');
        $ciclo = $request->input('ciclo');

        //GRAFICO SOLICITUDES DE PROMEDIO POR MES
        

        $meses = DB::table('egresados')
        ->selectRaw('FIELD(MONTH(created_at), 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12) AS Mes, (COUNT(created_at) / COUNT(DISTINCT YEAR(created_at)) ) as total' )
        ->groupBy('Mes')
        ->get();

        $datosMes = [];
        
        foreach($meses as $mes)
        {
            $datosMeses[] = ['name'=>$mes->Mes, 'y'=>floatval($mes->total)];
            
        }

        $jsonDataMes = json_encode($datosMeses);


        //GRAFICO SOLICITUDES PROMEDIO POR DIA

        $dias = DB::table('egresados')
        ->selectRaw('DAYOFWEEK(created_at) AS Dias, (COUNT(created_at) / (COUNT(DISTINCT YEAR(created_at)) * 52.1429)) as total' )
        ->groupBy('Dias')
        ->get();

        $datosDia = [];
        
        foreach($dias as $dia)
        {
            $datosDia[] = ['name'=>$dia->Dias, 'y'=>floatval($dia->total)];
            
        }

        $jsonDataDia = json_encode($datosDia);
        //...........................
               
        if($ciclo == "todos" AND $pe == "todos" )
        {
  
                // Primera Parte
                $modalidades = DB::table('academicos')
                ->join('modalidades', 'modalidades.id', '=', 'academicos.modalidad_id')
                ->selectRaw('modalidades.modalidad, count(academicos.modalidad_id) AS total')
                ->groupBy('modalidades.modalidad')
                ->orderBy('total', 'DESC')
                ->get();

                $datosModalidad = [];

                foreach($modalidades as $modalidad)
                {
                    $datosModalidad[] = ['name'=>$modalidad->modalidad, 'y'=>floatval($modalidad->total)];
                    
                }

                $jsonDataModalidad = json_encode($datosModalidad);

                //......................................................

                $modalidades_licenciaturas = DB::table('academicos')
                ->join('egresados', 'egresados.id', '=', 'academicos.egresado_id')
                ->selectRaw('academicos.licenciatura, count(egresados.created_at) AS total')
                ->groupBy('academicos.licenciatura')
                ->orderBy('total', 'DESC')
                ->get();

                $datosModalidad_Licenciatura = [];

                foreach($modalidades_licenciaturas as $modalidad_licenciatura)
                {
                    $datosModalidad_Licenciatura[] = ['name'=>$modalidad_licenciatura->licenciatura, 'y'=>floatval($modalidad_licenciatura->total)];
                    
                }

                $jsonDataModalidad_Licenciatura = json_encode($datosModalidad_Licenciatura);

                //Segunda parte

                $promedios = DB::table('academicos')
                                ->join('egresados', 'egresados.id', '=', 'academicos.egresado_id')
                                ->selectRaw('DISTINCT(academicos.modalidad_id) AS Modalidades, 
                                            COUNT(CASE WHEN academicos.promedio = 10 THEN 1 END) AS Diez, 
                                            COUNT(CASE WHEN academicos.promedio = 9 THEN 1 END) AS Nueve ,
                                            COUNT(CASE WHEN academicos.promedio = 8 THEN 1 END) AS Ocho,
                                            COUNT(CASE WHEN academicos.promedio = 7 THEN 1 END) AS Siete')
                                ->groupBy('Modalidades')
                                ->get();
                    
                                $datosPromedios = [];
                            
                                foreach($promedios as $promedio)
                                {
                                    $datosPromedio[] = ['diez'=>$promedio->Diez,'nueve'=>$promedio->Nueve,'ocho'=>$promedio->Ocho,'siete'=>$promedio->Siete];
                                    
                                }
                
                                $jsonDataPromedio = json_encode($datosPromedio);
                    
                // Grafico por estado civil

                                $estadosCiviles = DB::table('academicos')
                                ->join('egresados', 'egresados.id', '=', 'academicos.egresado_id')
                                ->selectRaw('CASE egresados.estado_civil 
                                            WHEN "soltero" THEN "Soltero"
                                            WHEN "casado" THEN "Casado"
                                            WHEN "separado" THEN "Separado"
                                            WHEN "viudo" THEN "Viudo"
                                            WHEN "union_libre" THEN "Unión Libre"
                                            END AS estado_civil, COUNT(egresados.estado_civil) AS total')
                                ->groupBy('egresados.estado_civil')
                                ->orderBy('total', 'ASC')
                                ->get();
                
                                $datosEstadoCivil = [];
                
                                foreach($estadosCiviles as $estadoCivil)
                                {
                                    $datosEstadoCivil[] = ['name'=>$estadoCivil->estado_civil, 'y'=>floatval($estadoCivil->total)];
                                    
                                }
                
                                $jsonDataEstadoCivil = json_encode($datosEstadoCivil);

                    //GRAFICO DE LICENCIATURAS Y ACTIVIDAD LABORAL

                                $actividadesLaborales = DB::table('academicos')
                                ->join('egresados', 'egresados.id', '=', 'academicos.egresado_id')
                                ->join('actividadesLaborales', 'actividadesLaborales.egresado_id', '=', 'academicos.egresado_id')
                                ->join('modalidades', 'modalidades.id', '=', 'academicos.modalidad_id')
                                ->selectRaw('modalidades.modalidad, COUNT(CASE WHEN actividadesLaborales.actividad_laboral = "si" THEN 1 END) AS total')
                                ->groupBy('modalidades.modalidad')
                                ->orderBy('total', 'DESC')
                                ->get();
                
                                $datosActividadLaboral = [];
                
                                foreach($actividadesLaborales as $actividadLaboral)
                                {
                                    $datosActividadLaboral[] = ['name'=>$actividadLaboral->modalidad, 'y'=>floatval($actividadLaboral->total)];
                                    
                                }
                
                                $jsonDataActividadLaboral = json_encode($datosActividadLaboral);
                    
                    //GRAFICO ACTIVIDAD LABORAL POR ESTADO CIVIL

                    $estadosCivilesActsLabs = DB::table('academicos')
                    ->join('egresados', 'egresados.id', '=', 'academicos.egresado_id')
                    ->join('actividadesLaborales', 'actividadesLaborales.egresado_id', '=', 'academicos.egresado_id')
                    ->selectRaw('actividadesLaborales.actividad_laboral, 
                                 COUNT(CASE WHEN egresados.estado_civil = "soltero" THEN 1 END) AS Soltero,
                                 COUNT(CASE WHEN egresados.estado_civil = "casado" THEN 1 END) AS Casado,
                                 COUNT(CASE WHEN egresados.estado_civil = "viudo" THEN 1 END) AS Viudo,
                                 COUNT(CASE WHEN egresados.estado_civil = "union_libre" THEN 1 END) AS Union_Libre,
                                 COUNT(CASE WHEN egresados.estado_civil = "separado" THEN 1 END) AS Separado
                                 ')
                    ->groupBy('actividadesLaborales.actividad_laboral')
                    ->get();
        
                    $datosEstadosCivilesActsLabs = [];
                
                    foreach($estadosCivilesActsLabs as $estadoCivilActLab)
                    {
                        $datosEstadosCivilesActsLabs[] = ['soltero'=>$estadoCivilActLab->Soltero,'casado'=>$estadoCivilActLab->Casado,'viudo'=>$estadoCivilActLab->Viudo,'union_libre'=>$estadoCivilActLab->Union_Libre,'separado'=>$estadoCivilActLab->Separado];
                        
                    }
    
                    $jsonEstadosCivilesActsLabs = json_encode($datosEstadosCivilesActsLabs);
            }
            
            else if($ciclo != "todos" AND $pe != "todos" )
            {
                //Primera Parte
                $modalidades = DB::table('academicos')
                ->join('modalidades', 'modalidades.id', '=', 'academicos.modalidad_id')
                ->selectRaw('modalidades.modalidad, count(academicos.modalidad_id) AS total')
                ->where('academicos.licenciatura', '=', $pe)
                ->where(DB::raw('left(academicos.matricula,2)') , '=' , $ciclo)
                ->groupBy('modalidades.modalidad')
                ->get();

                $datosModalidad = [];

                foreach($modalidades as $modalidad)
                {
                    $datosModalidad[] = ['name'=>$modalidad->modalidad, 'y'=>floatval($modalidad->total)];
                    
                }

                $jsonDataModalidad = json_encode($datosModalidad);

                //......................................................

                $modalidades_licenciaturas = DB::table('academicos')
                ->join('egresados', 'egresados.id', '=', 'academicos.egresado_id')
                ->selectRaw('academicos.licenciatura, count(egresados.created_at) AS total')
                ->Where(DB::raw('left(academicos.matricula,2)') , '=' , $ciclo)
                ->groupBy('academicos.licenciatura')
                ->orderBy('total', 'DESC')
                ->get();

                $datosModalidad_Licenciatura = [];

                foreach($modalidades_licenciaturas as $modalidad_licenciatura)
                {
                    $datosModalidad_Licenciatura[] = ['name'=>$modalidad_licenciatura->licenciatura, 'y'=>floatval($modalidad_licenciatura->total)];
                    
                }

                $jsonDataModalidad_Licenciatura = json_encode($datosModalidad_Licenciatura);

                //Segunda Parte


                $promedios = DB::table('academicos')
                                ->join('egresados', 'egresados.id', '=', 'academicos.egresado_id')
                                ->selectRaw('DISTINCT(academicos.modalidad_id) AS Modalidades, 
                                            COUNT(CASE WHEN academicos.promedio = 10 THEN 1 END) AS Diez, 
                                            COUNT(CASE WHEN academicos.promedio = 9 THEN 1 END) AS Nueve ,
                                            COUNT(CASE WHEN academicos.promedio = 8 THEN 1 END) AS Ocho,
                                            COUNT(CASE WHEN academicos.promedio = 7 THEN 1 END) AS Siete')
                                ->where('academicos.licenciatura', '=', $pe)
                                ->where(DB::raw('left(academicos.matricula,2)') , '=' , $ciclo)
                                ->groupBy('Modalidades')
                                ->get();
                    
                                $datosPromedios = [];
                            
                                foreach($promedios as $promedio)
                                {
                                    $datosPromedio[] = ['diez'=>$promedio->Diez,'nueve'=>$promedio->Nueve,'ocho'=>$promedio->Ocho,'siete'=>$promedio->Siete];
                                    
                                }
                
                                $jsonDataPromedio = json_encode($datosPromedio);
                    
                // Grafico por estado civil

                                $estadosCiviles = DB::table('academicos')
                                ->join('egresados', 'egresados.id', '=', 'academicos.egresado_id')
                                ->selectRaw('CASE egresados.estado_civil 
                                            WHEN "soltero" THEN "Soltero"
                                            WHEN "casado" THEN "Casado"
                                            WHEN "separado" THEN "Separado"
                                            WHEN "viudo" THEN "Viudo"
                                            WHEN "union_libre" THEN "Unión Libre"
                                            END AS estado_civil, COUNT(egresados.estado_civil) AS total')
                                ->where('academicos.licenciatura', '=', $pe)
                                ->where(DB::raw('left(academicos.matricula,2)') , '=' , $ciclo)
                                ->groupBy('egresados.estado_civil')
                                ->orderBy('total', 'ASC')
                                ->get();
                
                                $datosEstadoCivil = [];
                
                                foreach($estadosCiviles as $estadoCivil)
                                {
                                    $datosEstadoCivil[] = ['name'=>$estadoCivil->estado_civil, 'y'=>floatval($estadoCivil->total)];
                                    
                                }
                
                                $jsonDataEstadoCivil = json_encode($datosEstadoCivil);

                    //GRAFICO DE MODALIDADES Y ACTIVIDAD LABORAL

                                $actividadesLaborales = DB::table('academicos')
                                ->join('egresados', 'egresados.id', '=', 'academicos.egresado_id')
                                ->join('actividadesLaborales', 'actividadesLaborales.egresado_id', '=', 'academicos.egresado_id')
                                ->join('modalidades', 'modalidades.id', '=', 'academicos.modalidad_id')
                                ->selectRaw('modalidades.modalidad, COUNT(CASE WHEN actividadesLaborales.actividad_laboral = "si" THEN 1 END) AS total')
                                ->where('academicos.licenciatura', '=', $pe)
                                ->where(DB::raw('left(academicos.matricula,2)') , '=' , $ciclo)
                                ->groupBy('modalidades.modalidad')
                                ->orderBy('total', 'DESC')
                                ->get();
                
                                $datosActividadLaboral = [];
                
                                foreach($actividadesLaborales as $actividadLaboral)
                                {
                                    $datosActividadLaboral[] = ['name'=>$actividadLaboral->modalidad, 'y'=>floatval($actividadLaboral->total)];
                                    
                                }
                
                                $jsonDataActividadLaboral = json_encode($datosActividadLaboral);
                    
                    //GRAFICO ACTIVIDAD LABORAL POR ESTADO CIVIL

                    $estadosCivilesActsLabs = DB::table('academicos')
                    ->join('egresados', 'egresados.id', '=', 'academicos.egresado_id')
                    ->join('actividadesLaborales', 'actividadesLaborales.egresado_id', '=', 'academicos.egresado_id')
                    ->selectRaw('actividadesLaborales.actividad_laboral, 
                                 COUNT(CASE WHEN egresados.estado_civil = "soltero" THEN 1 END) AS Soltero,
                                 COUNT(CASE WHEN egresados.estado_civil = "casado" THEN 1 END) AS Casado,
                                 COUNT(CASE WHEN egresados.estado_civil = "viudo" THEN 1 END) AS Viudo,
                                 COUNT(CASE WHEN egresados.estado_civil = "union_libre" THEN 1 END) AS Union_Libre,
                                 COUNT(CASE WHEN egresados.estado_civil = "separado" THEN 1 END) AS Separado
                                 ')
                    ->where('academicos.licenciatura', '=', $pe)
                    ->where(DB::raw('left(academicos.matricula,2)') , '=' , $ciclo)
                    ->groupBy('actividadesLaborales.actividad_laboral')
                    ->get();
        
                    $datosEstadosCivilesActsLabs = [];
                
                    foreach($estadosCivilesActsLabs as $estadoCivilActLab)
                    {
                        $datosEstadosCivilesActsLabs[] = ['soltero'=>$estadoCivilActLab->Soltero,'casado'=>$estadoCivilActLab->Casado,'viudo'=>$estadoCivilActLab->Viudo,'union_libre'=>$estadoCivilActLab->Union_Libre,'separado'=>$estadoCivilActLab->Separado];
                        
                    }
    
                    $jsonEstadosCivilesActsLabs = json_encode($datosEstadosCivilesActsLabs);
                
            }
            else
            {
                //Primera Parte
                $modalidades = DB::table('academicos')
                ->join('modalidades', 'modalidades.id', '=', 'academicos.modalidad_id')
                ->selectRaw('modalidades.modalidad, count(academicos.modalidad_id) AS total')
                ->where('academicos.licenciatura', '=', $pe)
                ->orWhere(DB::raw('left(academicos.matricula,2)') , '=' , $ciclo)
                ->groupBy('modalidades.modalidad')
                ->get();

                $datosModalidad = [];

                foreach($modalidades as $modalidad)
                {
                    $datosModalidad[] = ['name'=>$modalidad->modalidad, 'y'=>floatval($modalidad->total)];
                    
                }

                $jsonDataModalidad = json_encode($datosModalidad);

                //......................................................

                $modalidades_licenciaturas = DB::table('academicos')
                ->join('egresados', 'egresados.id', '=', 'academicos.egresado_id')
                ->selectRaw('academicos.licenciatura, count(egresados.created_at) AS total')
                ->Where(DB::raw('left(academicos.matricula,2)') , '=' , $ciclo)
                ->groupBy('academicos.licenciatura')
                ->orderBy('total', 'DESC')
                ->get();

                $datosModalidad_Licenciatura = [];

                foreach($modalidades_licenciaturas as $modalidad_licenciatura)
                {
                    $datosModalidad_Licenciatura[] = ['name'=>$modalidad_licenciatura->licenciatura, 'y'=>floatval($modalidad_licenciatura->total)];
                    
                }

                $jsonDataModalidad_Licenciatura = json_encode($datosModalidad_Licenciatura);

                //Segunda Parte


                $promedios = DB::table('academicos')
                                ->join('egresados', 'egresados.id', '=', 'academicos.egresado_id')
                                ->selectRaw('DISTINCT(academicos.modalidad_id) AS Modalidades, 
                                            COUNT(CASE WHEN academicos.promedio = 10 THEN 1 END) AS Diez, 
                                            COUNT(CASE WHEN academicos.promedio = 9 THEN 1 END) AS Nueve ,
                                            COUNT(CASE WHEN academicos.promedio = 8 THEN 1 END) AS Ocho,
                                            COUNT(CASE WHEN academicos.promedio = 7 THEN 1 END) AS Siete')
                                ->where('academicos.licenciatura', '=', $pe)
                                ->orWhere(DB::raw('left(academicos.matricula,2)') , '=' , $ciclo)
                                ->groupBy('Modalidades')
                                ->get();
                    
                                $datosPromedios = [];
                            
                                foreach($promedios as $promedio)
                                {
                                    $datosPromedio[] = ['diez'=>$promedio->Diez,'nueve'=>$promedio->Nueve,'ocho'=>$promedio->Ocho,'siete'=>$promedio->Siete];
                                    
                                }
                
                                $jsonDataPromedio = json_encode($datosPromedio);
                    
                // Grafico por estado civil

                                $estadosCiviles = DB::table('academicos')
                                ->join('egresados', 'egresados.id', '=', 'academicos.egresado_id')
                                ->selectRaw('CASE egresados.estado_civil 
                                            WHEN "soltero" THEN "Soltero"
                                            WHEN "casado" THEN "Casado"
                                            WHEN "separado" THEN "Separado"
                                            WHEN "viudo" THEN "Viudo"
                                            WHEN "union_libre" THEN "Unión Libre"
                                            END AS estado_civil, COUNT(egresados.estado_civil) AS total')
                                ->where('academicos.licenciatura', '=', $pe)
                                ->orWhere(DB::raw('left(academicos.matricula,2)') , '=' , $ciclo)
                                ->groupBy('egresados.estado_civil')
                                ->orderBy('total', 'ASC')
                                ->get();
                
                                $datosEstadoCivil = [];
                
                                foreach($estadosCiviles as $estadoCivil)
                                {
                                    $datosEstadoCivil[] = ['name'=>$estadoCivil->estado_civil, 'y'=>floatval($estadoCivil->total)];
                                    
                                }
                
                                $jsonDataEstadoCivil = json_encode($datosEstadoCivil);

                    //GRAFICO DE MODALIDADES Y ACTIVIDAD LABORAL

                                $actividadesLaborales = DB::table('academicos')
                                ->join('egresados', 'egresados.id', '=', 'academicos.egresado_id')
                                ->join('actividadesLaborales', 'actividadesLaborales.egresado_id', '=', 'academicos.egresado_id')
                                ->join('modalidades', 'modalidades.id', '=', 'academicos.modalidad_id')
                                ->selectRaw('modalidades.modalidad, COUNT(CASE WHEN actividadesLaborales.actividad_laboral = "si" THEN 1 END) AS total')
                                ->where('academicos.licenciatura', '=', $pe)
                                ->orWhere(DB::raw('left(academicos.matricula,2)') , '=' , $ciclo)
                                ->groupBy('modalidades.modalidad')
                                ->orderBy('total', 'DESC')
                                ->get();
                
                                $datosActividadLaboral = [];
                
                                foreach($actividadesLaborales as $actividadLaboral)
                                {
                                    $datosActividadLaboral[] = ['name'=>$actividadLaboral->modalidad, 'y'=>floatval($actividadLaboral->total)];
                                    
                                }
                
                                $jsonDataActividadLaboral = json_encode($datosActividadLaboral);
                    
                    //GRAFICO ACTIVIDAD LABORAL POR ESTADO CIVIL

                    $estadosCivilesActsLabs = DB::table('academicos')
                    ->join('egresados', 'egresados.id', '=', 'academicos.egresado_id')
                    ->join('actividadesLaborales', 'actividadesLaborales.egresado_id', '=', 'academicos.egresado_id')
                    ->selectRaw('actividadesLaborales.actividad_laboral, 
                                 COUNT(CASE WHEN egresados.estado_civil = "soltero" THEN 1 END) AS Soltero,
                                 COUNT(CASE WHEN egresados.estado_civil = "casado" THEN 1 END) AS Casado,
                                 COUNT(CASE WHEN egresados.estado_civil = "viudo" THEN 1 END) AS Viudo,
                                 COUNT(CASE WHEN egresados.estado_civil = "union_libre" THEN 1 END) AS Union_Libre,
                                 COUNT(CASE WHEN egresados.estado_civil = "separado" THEN 1 END) AS Separado
                                 ')
                    ->where('academicos.licenciatura', '=', $pe)
                    ->orWhere(DB::raw('left(academicos.matricula,2)') , '=' , $ciclo)
                    ->groupBy('actividadesLaborales.actividad_laboral')
                    ->get();
        
                    $datosEstadosCivilesActsLabs = [];
                
                    foreach($estadosCivilesActsLabs as $estadoCivilActLab)
                    {
                        $datosEstadosCivilesActsLabs[] = ['soltero'=>$estadoCivilActLab->Soltero,'casado'=>$estadoCivilActLab->Casado,'viudo'=>$estadoCivilActLab->Viudo,'union_libre'=>$estadoCivilActLab->Union_Libre,'separado'=>$estadoCivilActLab->Separado];
                        
                    }
    
                    $jsonEstadosCivilesActsLabs = json_encode($datosEstadosCivilesActsLabs);
            }

            return view('admin-estadistica-egresado')->with(compact('jsonDataModalidad','jsonDataModalidad_Licenciatura','jsonDataMes','jsonDataDia','jsonDataPromedio', 'jsonDataEstadoCivil', 'jsonDataActividadLaboral', 'jsonEstadosCivilesActsLabs'));
     
        
    }

    public function consultarDescargar(Request $request)
    {
        
        $ciclo = $request->input('ciclo1');
        $pe = $request->input('pe');

        session(['ciclo' => $ciclo]);
        session(['pe' => $pe]);

        //$this->cicloExportar = $request->input('ciclo1');

        if($ciclo == "todos" AND $pe == "todos" )
        {
            $user = DB::table('academicos')
                        ->join('egresados', 'egresados.id', '=', 'academicos.egresado_id')
                        ->join('modalidades', 'modalidades.id', '=', 'academicos.modalidad_id')
                        ->selectRaw('egresados.id, academicos.matricula, academicos.licenciatura, egresados.apellidos, egresados.nombre, 
                                    egresados.sexo, egresados.edad, modalidades.modalidad, egresados.email, egresados.telefono, 
                                    egresados.created_at')
                        ->orderBy('egresados.created_at','DESC')
                        ->paginate(20);

        }
        else if($ciclo != "todos" AND $pe != "todos" )
        {
            $user = DB::table('academicos')
            ->join('egresados', 'egresados.id', '=', 'academicos.egresado_id')
            ->join('modalidades', 'modalidades.id', '=', 'academicos.modalidad_id')
            ->selectRaw('egresados.id, academicos.matricula, academicos.licenciatura, egresados.apellidos, egresados.nombre, 
                        egresados.sexo, egresados.edad, modalidades.modalidad, egresados.email, egresados.telefono, 
                        egresados.created_at')
            ->Where(DB::raw('left(academicos.matricula,2)') , '=' , $ciclo)
            ->Where('academicos.licenciatura' , '=' , $pe)

            ->orderBy('egresados.created_at','DESC')
            ->paginate(20);
        }
        else
        {
            $user = DB::table('academicos')
            ->join('egresados', 'egresados.id', '=', 'academicos.egresado_id')
            ->join('modalidades', 'modalidades.id', '=', 'academicos.modalidad_id')
            ->selectRaw('egresados.id, academicos.matricula, academicos.licenciatura, egresados.apellidos, egresados.nombre, 
                        egresados.sexo, egresados.edad, modalidades.modalidad, egresados.email, egresados.telefono, 
                        egresados.created_at')
            ->Where(DB::raw('left(academicos.matricula,2)') , '=' , $ciclo)
            ->orWhere('academicos.licenciatura' , '=' , $pe)

            ->orderBy('egresados.created_at','DESC')
            ->paginate(20);
        }

        
       
        return view('admin-consultar-descargar',compact('user'));        
    }

    public function exportar(Request $request)
    {
        $ciclo = session('ciclo');
        $pe = session('pe');

        
         
        return Excel::download(new EgresadosExport($ciclo, $pe), 'EgresadosDAMC.xlsx');
    }
}