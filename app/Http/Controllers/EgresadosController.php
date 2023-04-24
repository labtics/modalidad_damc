<?php
namespace App\Http\Controllers;

//Según se ocupen los modelos en las funciones o métodos se deben de declarar.

use Illuminate\Http\Request;
use App\Models\Egresado;
use App\Models\Academico;
use App\Models\Modalidad;
use App\Models\ActividadLaboral;
use App\Models\Comentario;
use App\Http\Requests\StoreEgresado;
use PDF;

use DB;

class EgresadosController extends Controller
{
    public function index()
    {

    }

    public function create()
    {

    }
    
    public function registro()
    {
        // La función create me permite mostrar la página inicial del sitio web
        // Al mismo tiempo a la vista se le pasa una variable denominada modalidades
        // la cual contiene los campos de la tabla Modalidades.

        $modalidades = Modalidad::all();
        return view('egresado-registro', compact('modalidades'));
    }

    public function store(StoreEgresado $request)
    {
        
        //EN RESUMEN
        //-------------------------------------------------------------
        //Este médodo guarda los datos del egresado según las tablas de la base de datos.
        //Al final la vista retorna una RUTA con alis "reporte_modalidad" la cual lleva una variable. La ruta apunta al método show() el cual
        // debe de recibir como argumento la variable matrícula que se le esta enviando (para más detalle ver la ruta con alias "reporte_modalidad")
        //----------------------------------------------------------------

        
        //Paso 1:
        //Se crea un objeto "Egresado" y "Académico" los cuales serán almacenados en las variables egresado y academicos
        //Su función será obtener todos los datos del formulario mediante la variable $request.
        
        //NOTA 1: La variable $request  accede a la instancia de la clase Request, que representa la solicitud HTTP actual. 
        //La variable $request se utiliza principalmente en los controladores de Laravel, que son responsables de procesar las solicitudes HTTP y proporcionar una respuesta correspondiente. 
        
        //NOTA 2: Cabe mencionar que en esta ocasión se esta ocupando una clase llamada "StoreEgresado" la cual hereda métodos y atributos de la clase Request, por esta razón la variable "$request" realiza su tarea.
        
        $egresado = new Egresado($request->all()); 
        $academico = new Academico($request->all());
        $actividadLaboral = new ActividadLaboral($request->all());
        $comentario = new Comentario($request->all());
        
        //Paso 2:
        //Se crea una variable $matrìcula la cual se obtiene de la variable "$academico" que es un objeto
        //La función de la variable "$matricula" servirá más adelante para buscar si existe otra matrìcula igual
        $matricula=$academico->matricula; 

        //Paso 3: Se crea una variable $buscaMatricula para guardar el resultado de la consulta, la cual compara si la matrìcula del egresado existe
       //Como resultado, esta consulta puede darnos 0 o màs registros
        $buscaMatricula = Academico::where('matricula' , '=', $matricula)->get();

        //Paso 5: Se crea una condición que evalúa si la variable "$buscaMatrícula" es mayor o igual 1
        //en caso que sea mayor o igual a 1, quiere decir que ya existe o hay un registro duplicado
        //en caso contrario, se guardaran los datos.
        if(count($buscaMatricula) >= 1)
        {
            //Si se encuentra otro registro, se redirecciona al usuario a la ruta "crear_registro" la cual
            //apunta al mètodo "create" de es te controlador, dicho método enviara al usario de nuevo a la vista "inicio"

            //NOTA: A esta ruta se le pasa una variable llamada "success" mediante el mètodo with, dicho mensaje
            //aparecera en la vista "inicio". Muy importante RECORDAR que en la vista "inicio" se deben "cachar" los
            //este mensaje
            return redirect()->route('modalidad.registro')->with('success', 'Estimado Egresado, tu matrícula ya existe en el sistema');
        }
        else
        {
            // Se procede a guardar los datos del formulario , los cuales fueron obtenidos por la variable $request
            
            
            
            $egresado->saveOrFail();
            $id=$egresado->id; 

            $academico->egresado_id=$id;
            $academico->saveOrFail();

            
            $institucion=$request->input("nombre_institución");
            
           
            if(is_null($institucion))
            {
                $institucion="";
            } 
         
            $actividadLaboral->nombre_institución=$institucion;           
            $actividadLaboral->egresado_id=$id;
            $actividadLaboral->saveOrFail();

            $opinion=$request->input("comentario");

            if(is_null($opinion))
            {
                $opinion="";
            } 

            $comentario->comentario=$opinion;           
            $comentario->egresado_id=$id;
            $comentario->saveOrFail();

            
            
           
            
            //Despuès de guardar los datos, se retornara una ruta, que lleva por nombre "reporte" Ver archivo de rutas. como también se le
            //pasa la variable $matricula para que la vista llamada "reporte" pueda trabajar con dicha variable.
            return redirect()->route('modalidad.show', $matricula)->with('success', 'Tus datos han sido registrados satisfactoriamente');
        }
        

        
        
    }

    public function show($matricula)
    {
        //El método show() entra en acción cuando la ruta "reporte_modalidad" recibe la variable matricula, y esta ruta apunta al método show el
        // cual en esta tarea, tiene el siguiente objetivo:
        // Se crea una variable, en este caso llamada "user" la cual va ser un array, que va almacenar la consulta SQL (que se encuentra en formato Eloquent),
        // y esta variable user será devuelta a la vista denomina "reporte". Al ejecutar la vista en el navegador, se observará que se listaran los datos del
        //usuario de acuerdo a los campos de la consulta. 

       $user = DB::table('academicos')
       ->join('egresados', 'academicos.egresado_id', '=', 'egresados.id')
       ->join('modalidades', 'academicos.modalidad_id', '=', 'modalidades.id')
       ->select('egresados.id', 'academicos.matricula', 'egresados.nombre', 'egresados.apellidos', 'modalidades.modalidad', 'egresados.created_at')
       ->where('academicos.matricula', '=', $matricula )
       ->get();

        return view('egresado-mostrar', compact('user'));
    }

    public function descargar($matricula)
    {
        //Este método recibe de la vista (ruta que se encuentra el botón "Reporte") una
        //variable llamada "matricula" la cual permitirá a la siguiente consulta obtener
        //un registro de los datos del egresado como su matrícula, nombre, apellidos, modalidad entre otros.
        
        $user = DB::table('academicos')
        ->join('egresados', 'academicos.egresado_id', '=', 'egresados.id')
        ->join('modalidades', 'academicos.modalidad_id', '=', 'modalidades.id')
        ->selectRaw('egresados.id as num, academicos.licenciatura, academicos.matricula, egresados.nombre, egresados.apellidos, modalidades.id,modalidades.modalidad, egresados.created_at')
        ->where('academicos.matricula', '=', $matricula )
        ->get();

        $modalidad = $user->first()->id; //La variable $modalidad obtiene el id que le corresponde a cada modalidad. Esta variable es creada para pasarla a la vista "documentación"
        $lic=$user->first()->licenciatura; //La variable $lic obtiene el valor del campo licenciatura. Las licenciaturas se encuentran abreviadas desde la Base de Datos. Esta misma variable pasará por un switch-

       
       //La variable $lic permitira mediante la condición switch asignar a la variable $licenciatura la licenciatura del egresado
       //Una vez terminado de asignar la Licenciatura se procede a ver la vista "documento" como un pdf, pasandole
       //tres variables, la modalidad, el user y la licenciatura , las cuales sirven para mostrar informaciòn al egresado como sus datos personales o académicos
       switch ($lic) {
            case "le":
                $licenciatura="Enfermería";
                break;
            case "lmc":
                $licenciatura="Médico Cirujano";
                break;
            case "lrf":
                $licenciatura="Rehabilitación Física";
                break;
            case "lapyd":
                $licenciatura="Atención Prehospitalaria y Desastrés";
                break;            
        }


        $pdf = \PDF::loadView('egresado-requerimientos',compact('modalidad','user', 'licenciatura'));
        return $pdf->stream('archivo.pdf');     
    }

    public function consultar(Request $request)
    {
               $matricula = $request->get('matricula');

               $user = DB::table('academicos')
               ->join('egresados', 'academicos.egresado_id', '=', 'egresados.id')
               ->join('modalidades', 'academicos.modalidad_id', '=', 'modalidades.id')
               ->selectRaw('egresados.id as num, academicos.licenciatura, academicos.matricula, egresados.nombre, egresados.apellidos, modalidades.id, modalidades.modalidad, egresados.created_at')
               ->where('academicos.matricula', '=', $matricula )
               ->get();
               
               if(count($user) >= 1)
               {
                 
               $modalidad = $user->first()->id; //La variable $modalidad obtiene el id que le corresponde a cada modalidad. Esta variable es creada para pasarla a la vista "documentación"
               $lic=$user->first()->licenciatura; //La variable $lic obtiene el valor del campo licenciatura. Las licenciaturas se encuentran abreviadas desde la Base de Datos. Esta misma variable pasará por un switch-
       
               switch ($lic) {
                   case "le":
                       $licenciatura="Enfermería";
                       break;
                   case "lmc":
                       $licenciatura="Médico Cirujano";
                       break;
                   case "lrf":
                       $licenciatura="Rehabilitación Física";
                       break;
                   case "lapyd":
                       $licenciatura="Atención Prehospitalaria y Desastrés";
                       break;            
               }

                 $pdf = \PDF::loadView('egresado-requerimientos',compact('modalidad','user', 'licenciatura'));
                    return $pdf->stream('archivo.pdf');  
                }

                else

                {
                    return redirect('modalidad/consultar/requerimientos')->with('success', 'La Matrícula no esta registrada o es incorrecta');
                }               
    }   


    public function edit()
    {

    }

    public function update()
    {

    }

    public function destroy()
    {

    }

    public function requerimientos ()
    {
        

    }

   

  
}
