@extends('layouts.app')

@section('title') 
  Modalidad
@endsection


@section('contenido') 


<link rel="stylesheet" href="{{asset('css/caja_azul.css')}}">


<script type="text/javascript">
  function compararMatricula() {
  var matricula = document.getElementById("matricula").value;
  var verificarMatri = document.getElementById("verificarMatri").value;

  if (matricula != verificarMatri) {
    alert("Tu matrícula no coincide, verifica porfavor");
    return false;
  }

  return true;
}
</script> 

<script>
function mostrarInput() {
  var opciones = document.getElementById("actividad_laboral");
  var divOculto = document.getElementById("ocultar");
  var inputOculto = document.getElementById("inputOculto");
  
  if (opciones.value === "no") 
  {
      divOculto.style.display = "none";
      inputOculto.value = "";
      inputOculto.removeAttribute('required');
    } 
    else 
    {
    divOculto.style.display = "block";
    inputOculto.setAttribute('required', '');
    }
}
</script>


<marquee>
	<b>Estimado Egresado, puedes consultar tu reporte de registro en la parte superior en el opción "Consultar Requerimientos"</b>
</marquee>
<br>
<br>

 <center><p class="caja"> REGISTRA TUS DATOS DE REQUERIMIENTOS DE TITULACIÓN</p> </center>
  <br>
  @include('layouts.mensajes')
  @if (session('success'))
        <div class="alert alert-danger"  role="alert">
            {{ session('success') }}
        </div>
@endif

<div class="centrar-form">  
<div class="row">
{!! Form::open(['route'=>'modalidad.store', 'id'=>'form', 'method' => 'post']) !!}

<fieldset>
<legend>Datos Personales</legend>
                        <div class="col-md-6">
                            <div class="form-group">
                              {!! Form::label('name', 'Nombre') !!}
                              {!! Form::text('nombre', null, ['class' => 'form-control', 'placeholder' => 'Obligatorio', 'required']) !!}
                             </div>
                        </div>

                      <div class="col-md-6">
                        <div class="form-group">
                           {!! Form::label('ape', 'Apellidos') !!}
                           {!! Form::text('apellidos', null, ['class' => 'form-control', 'placeholder' => 'Obligatorio', 'required']) !!}
                        </div>
                      </div>

                      <div class="col-md-2">
                        <div class="form-group">
                           {!! Form::label('eda', 'Edad') !!}
                           {!! Form::text('edad', null, ['class' => 'form-control', 'placeholder' => 'Obligatorio', 'required']) !!}
                        </div>
                      </div>

                      <div class="col-md-2 ">
                        <div class="form-group">
                          {!! Form::label('sex', 'Sexo') !!}
                          {!! Form::select('sexo', ['' => 'Selecciona','mujer' => 'Mujer', 'hombre' => 'Hombre'],null, ['class' => 'form-control', 'required']) !!}
                        </div>
                      </div>

                      <div class="col-md-2 ">
                        <div class="form-group">
                          {!! Form::label('estado_civil', 'Estado Civil') !!}
                          {!! Form::select('estado_civil', ['' => 'Selecciona','soltero' => 'Soltero/a', 'casado' => 'Casado/a', 'separado' => 'Separado/a', 'viudo' => 'Viudo/a','union_libre' => 'Unión Libre'],null, ['class' => 'form-control', 'required']) !!}
                        </div>
                      </div>

                      <div class="col-md-4">
                        <div class="form-group">
                            {!! Form::label('email', 'Correo Electrónico Personal') !!}
                            {!! Form::email('email', null, ['class' => 'form-control', 'placeholder' => 'ejemplo@correo.com', 'required']) !!}
                         </div>
                      </div>

                      <div class="col-md-2">
                        <div class="form-group">
                           {!! Form::label('telefono', 'Teléfono') !!}
                           {!! Form::text('telefono', null, ['class' => 'form-control', 'placeholder' => 'Obligatorio', 'required']) !!}
                        </div>
                      </div>

</fieldset>
<fieldset>
<legend>Datos Académicos</legend>

            
                      <div class="col-md-2">
                        <div class="form-group">
                           {!! Form::label('matri', 'Matrícula') !!}
                           {!! Form::text('matricula', null, ['class' => 'form-control', 'id' => 'matricula', 'placeholder' => 'Obligatorio','id'=>'matricula', 'required']) !!}
                        </div>
                    </div>

                  <div class="col-md-2">
                          <div class="form-group">
                             {!! Form::label('vermatri', 'Verificar Matrícula') !!}
                             {!! Form::text('verificarMatri', null,['class' => 'form-control', 'id' => 'verificarMatri', 'placeholder' => 'Obligatorio','id'=>'verificarMatri', 'required']) !!}
                          </div>
                  </div>

                      <div class="col-md-3">
                        <div class="form-group">
                          {!! Form::label('lic', 'Licenciatura') !!}
                          {!! Form::select('licenciatura', [''=>'Selecciona', 'le' => 'Enfermería', 'lrf' => 'Rehabilitación Física', 'lapyd' => 'Atención Preh. y Des.', 'lmc' => 'Médico Cirujano'],null, ['class' => 'form-control', 'required']) !!}
                        </div>
                      </div>
                      <div class="col-md-2">
                        <div class="form-group">
                           {!! Form::label('promedio', 'Promedio') !!}
                           {!! Form::text('promedio', null, ['class' => 'form-control', 'placeholder' => 'Obligatorio', 'required']) !!}
                        </div>
                      </div>

                      <div class="col-md-3">
                        <div class="form-group">
                          {!! Form::label('mod', 'Modalidad de Titulación') !!}
                          <select class="form-control" name="modalidad_id" id="modalidad_id" required>
                          <option value="">Selecciona una opción</option>
                            @foreach ($modalidades as $modalidad)
                              <option value="{{ $modalidad['id'] }}" {{ old('modalidad_id') == $modalidad['id'] ? 'selected' : '' }}>
                              {{ $modalidad['modalidad'] }}
                              </option>
                            @endforeach
                          </select>
                        </div>
                      </div>
 </fieldset>
 <fieldset>
<legend>Datos Laborales</legend>
                      <div class="col-md-4 ">
                        <div class="form-group">
                        <label for="opciones">Actividad Laboral Actual</label>
                            <select name= 'actividad_laboral' id='actividad_laboral' onChange="mostrarInput()" class="form-control" required>
                            <option value="">Selecciona una opción</option>
                            <option value="si">Si</option>
                              <option value="no">No </option>
                            </select>
                        </div>
                      </div>

                      <div class="col-md-8 ">
                        <div class="form-group">
                        <div id='ocultar' style="display: none;" >
                          <label for="opciones">Nombre de la Institución o Empresa</label>
                          <input type="text" name="nombre_institución" id="inputOculto" class="form-control" required>
                        </div>  
                      </div>
                      </div>


</fieldset>
<fieldset>
<legend>Comentarios</legend>
                    <div class="col-md-8 ">
                      <div class="form-group">
                        <div id='ocultar'>
                        {!! Form::label('comentario', 'Nos gustaría conocer tu opinión respecto a tu experiencia en la DAMC') !!}
                        <textarea name="comentario" class="form-control" rows="1" placeholder="Opcional"></textarea>
                        </div>  
                      </div>
                    </div>

                    <div class="col-md-4 ">
                      <div class="form-group">
                        {!! Form::label('experiencia', 'En general en la DAMC, tu experiencia ha sido:') !!}
                        {!! Form::select('experiencia', ['' => 'Selecciona','muy_buena' => 'Muy Buena', 'buena' => 'Buena', 'regular' => 'Regular', 'mala' => 'Mala', 'muy_mala' => 'Muy mala'],null, ['id' => 'actlab','class' => 'form-control', 'required']) !!}
                      </div>  
                    </div
</fieldset>
        
            <br> <br>
             <center>
              <button class="btn btn-success" onclick="compararMatricula()"> <span class="glyphicon glyphicon-floppy-saved" aria-hidden="true"></span> Guardar </button>
            </center>
            {!! Form::close() !!}
    </div>
  </div>

  @endsection