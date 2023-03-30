<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EgresadosController;
use App\Http\Controllers\RegistroUsuarioController;
use App\Http\Controllers\AutenticacionUsuarioController;
use App\Http\Controllers\AdministradoresController;




/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
// RUTA DEFAULT DE LARAVEL
Route::get('/', function () {
    return view('welcome');
});

//GESTIÓN DE RUTAS DEL MENÙ

//Esta ruta  dirige a la vista "tipo_modalidades"
Route::view('/modalidad/tipos', 'tipo_modalidades');

//Esta ruta dirige a la vista "consulta_requerimientos"
Route::view('/modalidad/consulta', 'consulta_requerimientos');

//Esta ruta dirige a la vista "login" (inicio de sesión)
Route::view('/modalidad/login', 'auth.login')->name('login');

Route::post('/modalidad/login', [AutenticacionUsuarioController::class,'store']);


Route::post('/modalidad/cerrar_sesion', [AutenticacionUsuarioController::class,'destroy'])->name('cerrar_sesion');


//Esta ruta dirige a la vista "registro" la cual se encuetra dentro de la carpeta "auth" y se referencia escribiendo el nombre la carpeta + punto + nombre de la vista (auth.registro)
// Su función es acceder por la URL "localhost:8000/modalidad/registro" a la vista registro
Route::view('/modalidad/registro', 'auth.registro')->name('registro');

//Estando dentro la URL "localhost:8000/modalidad/registro" (la ruta arriba anterior), esta ruta se ejecutará cuando
//se presione el botón "registrar" que se encuentra en la vista "registro".
//Su función es ir al método "store" del controlador RegistroUsuarioController", dicho método contiene todas las funcionalidades para registrar a un nuevo usuario
//Al finalizar su tarea el método "store" retornara la vista llamada "login" para que el usuario inicio sesiòn.
Route::post('/modalidad/registro', [RegistroUsuarioController::class,'store']);



//GESTIÓN DE RUTAS PARA EGRESADOS

 // Esta ruta dirige al método create del contolador EgresadoController. 
 //Entra en acción cuando se accede a la URL: localhost:8000/modalidad es decir a la ruta "modalidad"
 //Su funciòn es ir al método "create" del controllador "EgresadosController" para acceder a dicho método
 // y retornar la vista inicio. Nota: antes de regresar la vista, el método "create" cargará todas las modalidades a la vista inicio. Mas detalles ver Método "create" en el controlador EgresadosController

Route::get('modalidad',[EgresadosController::class,'create'])->name('crear_registro');

// Esta ruta dirige al método store del contolador EgresadoController. 
//Entra en acción cuando se presional el botón guardar de la vista "inicio". 
//Su función es llevar todos los datos del formulario para ser guardados en la base de datos
Route::post('modalidad', [EgresadosController::class,'store'])->name('registrar');

// Esta ruta dirige al método show del contolador EgresadoController. 
//Entra en acción cuando el método "store" retorna o llama a esta ruta con el nombre "reporte_modalidad", al mismo tiempo que se le envía una variable llamada "matrñicula". Dentro del método store existen ciertas condiciones. Ver Método "store" 
//Su función es ir al mètodo show para retornar una vista llamada "reporte" la cual se le envía a dicha vista una variable denominada "matricula" la cual mostrarà algunos datos guardados del egresado registrado

//NOTA: Esta ruta espera recibir una variable dentro de la URL, esta variable al llegar al método show servira para buscar a un egresado dentro de una consulta hecha en dicho mètodo.
Route::get('modalidad/{matricula}', [EgresadosController::class,'show'])->name('reporte_modalidad');

//Esta ruta dirige al método download del contolador EgresadoController. 
//Entra en acción cuando se presiona el botón "Descargar Requerimientos" que esta en la vista "Reporte"
//Su función es enviarle una variable al método "download" para que este ejecute una consulta y devuelva una vista convertida en PDF (Ver método "download") 

//NOTA: Esta ruta espera recibir una variable dentro de la URL, esta variable al llegar al método download ejecuta una consulta y acciones para al final retorna una vista llamada "documento" convertida en PDF, para que el egresado pueda descargar sus requerimientos de titulación
Route::get('modalidad/requerimientos/{matricula}', [EgresadosController::class, 'download'])->name('requerimientos_titulacion');


//Esta ruta dirige al método "consulta requerimientos" del contolador EgresadoController. 
//Entra en acción cuando se presiona el botón "Consultar Requerimientos" que esta en la vista "consultar_requerimientos"
//Su función es enviar el dato "matrìcula" por el mètodo post del formulario al método "consulta_requerimientos" del controlador EgresadosControlloer.
Route::post('modalidad/consulta/requerimientos', [EgresadosController::class,'consulta_requerimientos'])->name('consulta_requerimientos');


//GESTION DE RUTAS PARA ADMINISTRADOR

Route::get('modalidad/admin/panel', [AdministradoresController::class,'buscar_egresado'])->name('buscar_egresado')->middleware('auth');
Route::view('/modalidad/panel', 'panel')->middleware('auth');

Route::get('modalidad/{id}/edit', [AdministradoresController::class,'edit'])->name('editar')->middleware('auth');







