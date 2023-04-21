@extends('layouts.app')

@section('title') 
  Modalidad
@endsection


@section('contenido') 


<link rel="stylesheet" href="{{asset('css/caja_azul.css')}}">


<script type="text/javascript">
 
 function confirmacion() {
        return confirm('¿Estás seguro de que deseas actualizar la información del Egresado?');
    }

</script> 


<marquee>
	<b>Estimado Egresado, puedes consultar tu reporte de registro en la parte superior en el opción "Consulta tu Reporte"</b>
</marquee>
<br>
<br>
 <center><p class="caja"> EDITA LA INFORMACIÓN SOLICITADA</p> </center>
  <br>
  @include('mensajes')
  @if (session('success'))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
@endif
  <div class="centrar-form">  
  <form action="{{ route('actualizar',['id' => $user->id]) }}" method="post">  
    @csrf @method('PATCH')            
              <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                              {!! Form::label('name', 'Nombre') !!}
                              {!! Form::text('nombre', $user->nombre, ['class' => 'form-control', 'placeholder' => 'Obligatorio', 'required']) !!}
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                           {!! Form::label('ape', 'Apellidos') !!}
                           {!! Form::text('apellidos', $user->apellidos, ['class' => 'form-control', 'placeholder' => 'Obligatorio', 'required']) !!}
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                          {!! Form::label('mod', 'Modalidad de Titulación') !!}
                          <select class="form-control" name="modalidad_id" id="modalidad_id" required>
                          <option value="">{{ $user->modalidad }}</option>
                            @foreach ($modalidades as $modalidad)
                              <option value="{{ $modalidad['id'] }}">
                              {{ $modalidad['modalidad'] }}
                              </option>
                            @endforeach
                          </select>
                        </div>
                    </div>

            </div>
            
            <br> <br>
             <center>
              <button class="btn btn-success" onclick="return confirmacion()"> <span class="glyphicon glyphicon-cloud-upload" aria-hidden="true"></span> Guardar Edición </button>
            </center>
        </form>
  </div>
@endsection