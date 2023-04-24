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

<br>
<br>

 <center>
  <p class="caja"> CONSULTA TU REPORTE DE REQUERIMIENTOS</p> 
  <br>
  @if (session('success'))
        <div class="alert alert-warning" role="alert">
            {{ session('success') }}
        </div>
    @endif
  
  <div class="container">
    {!! Form::open(['route'=>'modalidad.consultar', 'id'=>'form', 'method'=>'post']) !!}
     <div class="input-group">
          {!!Form::text('matricula',null,['class'=>'form-control','placeholder'=>'Introduce tu Matrícula', 'required'])!!}
         <span class="input-group-btn" id="buscar">
         {!!Form::submit('Consultar Requerimientos',['class'=>'btn btn-primary'])!!} 
         </span>
      </div> 
  </div> 
  </center>

@endsection