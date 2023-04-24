@extends('layouts.app')

@section('title') 
  Modalidad
@endsection


@section('contenido') 

<link rel="stylesheet" href="{{asset('css/login.css')}}">
<link rel="stylesheet" href="{{asset('css/caja_azul.css')}}">

<center><p class="caja"> REGISTRAR USUARIO</p> </center>
<div class="global-container">
	<div class="card login-form">
	<div class="card-body">
		<div class="card-text">
		@include('layouts.mensajes')	
		<!--
			<div class="alert alert-danger alert-dismissible fade show" role="alert">Incorrect username or password.</div> -->
			<form method = "post">
                @csrf
				<!-- to error: add class "has-danger" -->
				<div class="form-group">
					<label>Nombre</label>
					<input type="name" name="name" class="form-control form-control-sm" id="name" value="{{ old('name') }}" autofocus='autofocus' required >
				</div>
				<div class="form-group">
					<label>Nombre de Usuario</label>
					<input type="username" name="username" class="form-control form-control-sm" id="username" value="{{ old('username') }}" required >
				</div>
				<div class="form-group">
					<label>Correo Electrónico</label>
					<input type="email" name="email" class="form-control form-control-sm" value="{{ old('email') }}" required>
				</div>
				<div class="form-group">
					<label>Contraseña</label>
					<!--<a href="#" style="floa:right;font-size:12px;">Forgot password?</a>-->
					<input type="password" name="password" class="form-control form-control-sm"  required>
				</div>
				<div class="form-group">
					<label>Confirmar Contraseña</label>
					<input type="password" name="password_confirmation" class="form-control form-control-sm" required >
				</div>
				<button type="submit" class="btn btn-success btn-block"> <span class="glyphicon glyphicon-user" aria-hidden="true"></span> Registrar Cuenta</button>
				
				<div class="sign-up">
					<!--Don't have an account? <a href="#">Create One</a>-->
				</div>
			</form>
		</div>
	</div>
</div>
</div>


@endsection