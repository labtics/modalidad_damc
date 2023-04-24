@extends('layouts.app')

@section('title') 
  Modalidad
@endsection


@section('contenido') 

<style type="text/css" media="screen">
    .caja {
        font-family: Century Gothic,CenturyGothic,AppleGothic,sans-serif;
        color: #ffffff;
        font-size: 0px;
        font-weight: 200;
        text-align: center;
        background: #337AB7;
        margin: 0 0 25px;
        overflow: hidden;
        padding: 0px;
        border-radius: 30px 30px 30px 30px;
        -moz-border-radius: 30px 30px 30px 30px;
        -webkit-border-radius: 30px 30px 30px 30px;
        border: 2px solid #337AB7;
    }
</style>

<link rel="stylesheet" href="{{asset('css/tabs_modalidades.css')}}">


<marquee>
	<b>Estimado Egresado, puedes consultar tu reporte de registro en la parte superior izquierda en el botón "Consulta tu Reporte"</b>
</marquee>
<br>
<br>

 <center><p class="caja"> Información de los tipos de Modalidad de Titulación</p> </center>
  <br>
  


<div class="tabset">
  <!-- Tab 1 -->
  <input type="radio" name="tabset" id="tab1" aria-controls="marzen" checked>
  <label for="tab1">Tesis</label>
  <!-- Tab 2 -->
  <input type="radio" name="tabset" id="tab2" aria-controls="rauchbier">
  <label for="tab2">EGC</label>
  <!-- Tab 3 -->
  <input type="radio" name="tabset" id="tab3" aria-controls="dunkles">
  <label for="tab3">CENEVAL</label>

  <input type="radio" name="tabset" id="tab4" aria-controls="dunkles">
  <label for="tab4">Maestría</label>

  <input type="radio" name="tabset" id="tab5" aria-controls="dunkles">
  <label for="tab5">Promedio</label>

  <input type="radio" name="tabset" id="tab6" aria-controls="dunkles">
  <label for="tab6">Artículo Publicado</label>

  <input type="radio" name="tabset" id="tab7" aria-controls="dunkles">
  <label for="tab7">Diplomado</label>
  
  <input type="radio" name="tabset" id="tab8" aria-controls="dunkles">
  <label for="tab8">Solución de Problemas</label>
  
  <div class="tab-panels">
    <section id="marzen" class="tab-panel">
      <h2>Tesis</h2>
      <br>
      Es un trabajo escrito derivado de una investigación, el cual deberá estar
relacionado con una problemática de la entidad o la nación en el área académica
correspondiente. El alumno o egresado tendrá derecho a escoger libremente el tema de
su tesis, siempre que tienda en lo posible a ser original y contribuya al estudio de temas
novedosos, principalmente relacionados con cuestiones de interés local, estatal,
regional, nacional o internacional y pertinente a la licenciatura que cursó.
  </section>
    <section id="rauchbier" class="tab-panel">
      <h2>Examen General de Conocimiento</h2>
      <br>
      Consiste en valorar si el egresado, ha adquirido
los conocimientos fundamentales de su carrera, si muestra capacidad para aplicarlos y
si posee la formación necesaria para ejercer su profesión. Esta opción tiene como
finalidad que el egresado demuestre mediante la evaluación respectiva, que posee la
preparación teórico-práctica requerida para su ejercicio profesional.
    </section>
    <section id="dunkles" class="tab-panel">
      <h2>Exámenes Generales para el Egreso de la Licenciatura (EGEL)</h2>
      <br>
      Los EGEL son instrumentos de evaluación estandarizados que tienen como propósito 
      evaluar los conocimientos y habilidades de un recién egresado. Son pruebas objetivas 
      con un referente de calificación criterial. Estos instrumentos miden el nivel de logro 
      de un sustentante con respecto a un estándar especializado por licenciatura.
    </section>
    <section id="dunkles" class="tab-panel">
    <h2>Estudios de Maestría</h2>
      <br>
      Esta opción consiste en la acreditación del cuarenta por ciento de créditos como mínimo, del 
      total de créditos del plan de estudios de posgrado, ya sea maestría o doctorado en alguna Institución Educativa 
      de nivel superior nacional o extranjera que posea reconocimiento oficial por parte de la Dirección General de Profesiones,
      dependiente de la Secretaría de Educación Pública. 
    </section>
    <section id="dunkles" class="tab-panel">
    <h2>Por Promedio</h2>
      <br>
      Consiste en la titulación sin réplica del examen profesional debiendo cumplir con los requisitos establecidos en este reglamento, 
      teniendo como finalidad motivar en el alumno o egresado el hábito de superación constante durante el trayecto de la licenciatura,
       factor determinante en su proyección profesional.
    </section>
    <section id="dunkles" class="tab-panel">
    <h2>Artículo Publicado</h2>
      <br>
      Consiste en la titulación sin réplica del examen profesional debiendo cumplir con los requisitos establecidos en este reglamento, 
      teniendo como finalidad motivar en el alumno o egresado el hábito de superación constante durante el trayecto de la licenciatura,
       factor determinante en su proyección profesional.
    </section>
    <section id="dunkles" class="tab-panel">
    <h2>Diplomado</h2>
      <br>
      Consiste en la asistencia, participación activa y aprobación de los egresados a un diplomado acorde a su licenciatura, con la 
      intervención de catedráticos y/o profesionales de reconocido prestigio, organizado por la División Académica correspondiente.
       El diplomado deberá estar integrado por un mínimo de ciento veinte horas con un valor de quince a diecisiete créditos. En el 
       transcurso o término del diplomado el egresado deberá elaborar un trabajo documental escrito individual acorde a lo impartido,
      el cual presentará y defenderá durante el examen profesional.  
    </section>
    <section id="dunkles" class="tab-panel">
    <h2>Solución de Problemas</h2>
      <br>
     En revisión 
    </section>
  </div>
  
</div>
@endsection