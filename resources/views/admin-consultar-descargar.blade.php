@extends('layouts.app')

@section('title') 
  Modalidad
@endsection


@section('contenido') 

<link rel="stylesheet" href="{{asset('css/caja_azul.css')}}">
<style type="text/css" media="screen">

table {
   margin: auto;
   width: 100%;
   border: 1px solid #5ABA47;


}
th, td {
   width: 0%;
   text-align: center;
   vertical-align: top;
   padding: 0.3em;
   caption-side: bottom;
}

th {
   background: #5ABA47;
    color: #fff;
    vertical-align: top;
}

p{
   font-weight: bold;
 }

 .contenedor{
  display: flex;
  justify-content: space-between;
}

select, button {
  display: inline-block;
  margin-right: 10px;
}

</style>

 <center><p class="caja"> DESCARGA MASIVA DE DATOS </p> </center>
  <br>
  
  <form action="{{route('modalidad.consultarDescargar')}}" method="get">
      
  <div class="contenedor">
            <select class="form-control" name="pe" id="pe">
                    <option value=""> Selecciona Programa Educativo </option>
                    <option value="lmc"> Médico Cirujano</option>
                    <option value="le"> Enfermería</option>
                    <option value="lrf"> Rehabilitación Física</option>
                    <option value="lapyd"> Atención Prehospitalaria y Desastres</option>
                    <option value="todos"> Todos</option>
            </select>

            <select class="form-control" name="ciclo1" id="ciclo1">
                  <option value=""> Selecciona Ciclo Escolar </option>
                    <option value="09"> 2009</option>
                    <option value="10"> 2010</option>
                    <option value="11"> 2011</option>
                    <option value="12"> 2012</option>
                    <option value="13"> 2013</option>
                    <option value="14"> 2014</option>
                    <option value="15"> 2015</option>
                    <option value="16"> 2016</option>
                    <option value="17"> 2017</option>
                    <option value="18"> 2018</option>
                    <option value="19"> 2019</option>
                    <option value="20"> 2020</option>
                    <option value="21"> 2021</option>
                    <option value="22"> 2022</option>
                    <option value="23"> 2023</option>
                    <option value="24"> 2024</option>
                    <option value="25"> 2025</option>
                    <option value="26"> 2026</option>


                    <option value="todos"> Todos</option>
            </select>

          <button class="btn btn-warning" > <span class="glyphicon glyphicon-search" aria-hidden="true"></span> Consultar </button> 
  </form>

  <form action="{{route('modalidad.exportar')}}" method="get">
          <button class="btn btn-info" > <span class="glyphicon glyphicon-download-alt" aria-hidden="true"></span> Descargar </button>
  </form>
  </div>
  <br>
            <center>
            <div align='center'>
                  <strong>Egresados Encontrados:</strong> 
                  <p style="color:red;">{{$user->total()}} </p> 
            </div>
            </center> 
          @if(isset($user) || isset($i)) 
              @php
                $i = 0
              @endphp
              <table class="table table-striped">
                  <thead>
                    <tr>
                      <th>Núm.</th>
                      <th>Matrícula</th>
                      <th>Licenciatura</th>
                      <th>Apellidos</th>
                      <th>Nombre</th>
                      <th>Sexo</th>
                      <th>Edad</th>
                      <th>Modalidad</th>
                      <th>Email</th>
                      <th>Teléfono</th>
                      <th>Fecha</th>
                    </tr>
                  </thead>
                  <tbody>
                  @foreach($user as $egresado)
                    <tr>
                      <td>{{++$i}}</td>
                      <td>{{$egresado->matricula}}</td>
                      <td>{{$egresado->licenciatura}}</td>
                      <td>{{ucwords($egresado->apellidos)}}</td>
                      <td>{{ucwords($egresado->nombre)}}</td>
                      <td>{{ucwords($egresado->sexo)}}</td>
                      <td>{{$egresado->edad}}</td>
                      <td>{{$egresado->modalidad}}</td>
                      <td>{{$egresado->email}}</td>
                      <td>{{$egresado->telefono}}</td>
                      <td>{{$egresado->created_at}}</td>
                    </tr>
                  @endforeach
                  </tbody>
              </table>
              <center> {{ $user->appends(request()->input())->links() }} </center>
              @endif
  
@endsection