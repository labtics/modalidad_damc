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

</style>

 <center><p class="caja"> PANEL DE CONTROL | Buscar Egresado </p> </center>
  <br>

  <a href="{{url('damc/coordinador/inicio')}}" class="btn btn-success"><span class="glyphicon glyphicon-home" aria-hidden="true"></span> Inicio</a>

  <button class="btn btn-warning hidden-print" onclick="window.print();"><span class="glyphicon glyphicon-print" aria-hidden="true"></span> Imprimir </button>

        <form action="{{route('buscar_egresado')}}" method="get">
          <br>
          <div class="input-group">
            {!!Form::text('name',null,['class'=>'form-control','placelhoder'=>'Buscar'])!!}
               <span class="input-group-btn" id="buscar">
                  {!!Form::submit('Buscar',['class'=>'btn btn-primary'])!!} 
               </span>
          </div>           
          <br>
          @if(isset($user) || isset($i)) 
              <center>
                <strong>Coincidencias de registros:</strong> 
                  <p style="color:red;">{{$user->total()}} </p> 
              </center>
              <br>          
              @php
                $i = 0
              @endphp
              <table class="table table-striped">
                  <thead>
                    <tr>
                      <th>Núm.</th>
                      <th>Matrícula</th>
                      <th>Lic.</th>
                      <th>Apellidos</th>
                      <th>Nombre</th>
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
                      <td>{{$egresado->created_at}}</td>
                    </tr>
                  @endforeach
                  
                  </tbody>
              </table>
              <center> {{ $user->appends(request()->input())->links() }} </center>

              @endif
        </form>

@endsection