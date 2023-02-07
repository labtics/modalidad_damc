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

<marquee>
	<b>Estimado Egresado, puedes consultar tu reporte de registro en la parte superior izquierda en el botón "Consulta tu Reporte"</b>
</marquee>
<br>
<br>

 <center><p class="caja"> REGISTRA LOS DATOS DE TU MODALIDAD DE TITULACIÓN</p> </center>
  <br>
  <div class="centrar-form">                
                  <div class="row">

                        <div class="col-md-6">
                            <div class="form-group">
                              {!! Form::label('name', 'Nombre') !!}
                                {!! Form::text('nombre', null, ['class' => 'form-control', 'placeholder' => 'Obligatorio']) !!}
                             </div>
                        </div>

                      <div class="col-md-6">
                        <div class="form-group">
                           {!! Form::label('ape', 'Apellidos') !!}
                           {!! Form::text('apellidos', null, ['class' => 'form-control', 'placeholder' => 'Obligatorio']) !!}
                        </div>
                      </div>

                      <div class="col-md-2 ">
                        <div class="form-group">
                          {!! Form::label('sex', 'Sexo') !!}
                          {!! Form::select('sexo', ['' => 'Selecciona','mujer' => 'Mujer', 'hombre' => 'Hombre'],null, ['class' => 'form-control']) !!}
                        </div>
                      </div>

                      <div class="col-md-2">
                        <div class="form-group">
                           {!! Form::label('eda', 'Edad') !!}
                           {!! Form::text('edad', null, ['class' => 'form-control', 'placeholder' => 'Obligatorio']) !!}
                        </div>
                      </div>

                      <div class="col-md-5">
                        <div class="form-group">
                            {!! Form::label('email', 'Correo Electrónico Personal') !!}
                            {!! Form::email('email', null, ['class' => 'form-control', 'placeholder' => 'ejemplo@correo.com']) !!}
                         </div>
                      </div>

                      <div class="col-md-3">
                        <div class="form-group">
                           {!! Form::label('tel', 'Celular') !!}
                           {!! Form::text('celular', null, ['class' => 'form-control', 'placeholder' => 'Obligatorio']) !!}
                        </div>
                      </div>
            
                      <div class="col-md-3">
                        <div class="form-group">
                           {!! Form::label('matri', 'Matrícula') !!}
                           {!! Form::text('matricula', null, ['class' => 'form-control', 'placeholder' => 'Obligatorio','id'=>'matricula']) !!}
                        </div>
                    </div>

                  <div class="col-md-3">
                          <div class="form-group">
                             {!! Form::label('vermatri', 'Verificar Matrícula') !!}
                             {!! Form::text('verificarMatri', null,['class' => 'form-control', 'placeholder' => 'Obligatorio','id'=>'verificarMatri']) !!}
                          </div>
                  </div>

                      <div class="col-md-3">
                        <div class="form-group">
                          {!! Form::label('lic', 'Licenciatura') !!}
                          {!! Form::select('licenciatura', [''=>'Selecciona', 'le' => 'Enfermería', 'lrf' => 'Rehabilitación Física', 'lapyd' => 'Atención Preh. y Des.', 'lmc' => 'Médico Cirujano'],null, ['class' => 'form-control']) !!}
                        </div>
                      </div>

                      <div class="col-md-3">
                        <div class="form-group">
                          {!! Form::label('mod', 'Modalidad de Titulación') !!}
                          {!! Form::select('modalidad', [''=>'Selecciona', 'te' => 'Tesis', 'cen' => 'CENEVAL', 'egc' => 'Examen Gral. Con.', 'arpu' => 'Artículo Publicado'],null, ['class' => 'form-control']) !!}
                        </div>
                      </div>

                  </div>
            <br> <br>
             <center>
                     {!!link_to('#','Guardar', ['id'=>'guardar','class'=>'btn btn-primary'])!!}
            </center>
</div>
</div>
@endsection