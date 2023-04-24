@extends('layouts.app')

@section('title') 
  Modalidad
@endsection


@section('contenido') 

<link rel="stylesheet" href="{{asset('css/login.css')}}">


<link rel="stylesheet" href="{{asset('css/caja_azul.css')}}">
<center><p class="caja"> INICIAR SESIÓN</p> </center>

<div class="global-container">
	<div class="card login-form">
	<div class="card-body">
		<div class="card-text">
		@include('layouts.mensajes')
			<!--
			<div class="alert alert-danger alert-dismissible fade show" role="alert">Incorrect username or password.</div> -->
			<form  method = "post">
                @csrf
				<!-- to error: add class "has-danger" -->
				<div class="form-group">
					<label for="exampleInputEmail1">Correo Electrónico</label>
					<input type="email" name="email" class="form-control form-control-sm" id="exampleInputEmail1" aria-describedby="emailHelp" required>
				</div>
				<div class="form-group">
					<label for="exampleInputPassword1">Contraseña</label>
					<!--<a href="#" style="float:right;font-size:12px;">Forgot password?</a>-->
					<input type="password" name="password" class="form-control form-control-sm" id="exampleInputPassword1"  required>
				</div>
				<button type="submit" class="btn btn-success btn-block"><span class="glyphicon glyphicon-circle-arrow-right" aria-hidden="true"></span> Entrar</button>
				
				<div class="sign-up">
					<!--Don't have an account? <a href="#">Create One</a>-->
				</div>
			</form>
		</div>
	</div>
</div>
</div>


@endsection