@extends('layouts.app')

@section('title') 
  Modalidad
@endsection


@section('contenido') 


<style type="text/css" media="screen">

table {
   margin: auto;
   width: 100%;
   border: 1px solid #5ABA47;


}
th, td {
   width: 20%;
   text-align: center;
   vertical-align: top;
   padding: 0.3em;
   caption-side: bottom;
}

th {
   background: #5ABA47;
}

p{
	 font-weight: bold;
 }


</style>


@if (session('success'))
        <div class="alert alert-success"  role="alert">
            {{ session('success') }}
        </div>
@endif

<div>
			<table>
				
				<thead>
					<tr>
						<th>Matrícula</th>
						<th>Nombre</th>
						<th>Apellidos</th>
						<th>Modalidad</th>
						<th>Fecha</th>

					</tr>
				</thead>
				<tbody>
			
					<tr>
						<td>{{$user[0]->matricula}}</td>
						<td>{{$user[0]->nombre}}</td>
						<td>{{$user[0]->apellidos}}</td>
						<td>{{$user[0]->modalidad}}</td>
						<td>{{$user[0]->created_at}}</td>
					</tr>
				</tbody>
			</table>

	<br> <br>

		<br> <br>


	<center>
		<div class="form-group">
			<a class="btn btn-primary" href="{{route('requerimientos_titulacion', $user[0]->matricula)}}">Descargar Requerimientos</a>
	    </div>
    </center>

</div>

@endsection