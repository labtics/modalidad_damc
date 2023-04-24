@extends('layouts.app')

@section('title') 
  Modalidad
@endsection

@section('contenido')

<div class="container">
<div class="row">
    <div class="col-lg-12">
        <h3 class="centraTexto" style="position:relative; top:-30px;  font-size: 22px; font-weight: bold; text-align: center">Estimados Egresados</h3>
        <p  style="text-align: justify; font-size: 18px"> 
        Este espacio fue diseñado para registrar tu modalidad de titulación además de mantener acercamiento 
        y cooperación con nuestra comunidad de egresadas y egresados. Por ello, encontrarás información de interés 
        sobre eventos, noticias y educación contínua dentro de la institución con el objetivo de fortalecer tu desempeño profesional y 
        desarrollo personal. 
        </p>
    </div>
</div>
<h3  style="text-align: center; font-size: 18px"> Elige el enlace con disponibilidad o de tu interés </h3>
<div class="row">

<div class="col-sm-6 col-md-4">
<div class="thumbnail">
  <img src="{{asset('img/egresados.jpg')}}"></script>
 <alt="" class="img-rounded">
  <div class="caption">
    <h3 class="centraTexto" style="text-align: center">Eventos</h3>
    <p style="text-align: center"><a href="#" class="btn btn-danger" role="button">Accede</a></p>
  </div>
</div>

</div>
<div class="col-sm-6 col-md-4">
<div class="thumbnail">
  <img src="{{asset('img/noticias.jpg')}}" alt="" class="img-rounded">
  <div class="caption">
    <h3 class="centraTexto" style="text-align: center">Noticias</h3>
    <p style="text-align: center""><a href="#" class="btn btn-danger" role="button">Ver</a></p>
  </div>
</div>

</div>
<div class="col-sm-6 col-md-4">
<div class="thumbnail">
  <img src="{{asset('img/educacion.jpg')}}" alt="" class="img-rounded">
  <div class="caption">
    <h3 class="centraTexto"style="text-align: center">Educación contínua</h3>
    <p style="text-align: center"><a href="#" class="btn btn-danger" role="button">Revisa</a></p>
  </div>
</div>

</div>
</div>
@endsection