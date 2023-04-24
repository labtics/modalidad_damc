<!DOCTYPE html>
<html lang="es">

 <head>
	    <meta charset="utf-8">
	    <title>@yield('title', 'Default') Titulación</title>
	    
	    <link rel="stylesheet" href="{{asset('plugins/bootstrap/css/bootstrap.min.css')}}">
	    <link rel="stylesheet" href="{{asset('plugins/bootstrap/js/bootstrap.min.js')}}">
		<link rel="stylesheet" href="{{asset('css/fondo_pagina.css')}}">
		<link rel="stylesheet" href="{{asset('css/caja_blanca_transparente.css')}}">
	    <link rel="stylesheet" href="{{asset('css/footer.css')}}">

		<link href="https://fonts.googleapis.com/css?family=Coda" rel="stylesheet">
</head>
<body>
   		<div class="container">
		    <!-- INICIA EL BARNER -->
		   	<img src="{{asset('img/modalidad.jpg')}}"  width="1140"  alt="">
				<!-- INICIA EL MENU HORIZONTAL -->
   	    			@include('layouts.menu') 
					<!-- PERMITE ENVIAR MENSAJES DE INFORMACIÒN AL USUARIO -->
						@if (Auth::guest())
                       
					   @else   
					   <div style="float:right;margin-right:65px;margin-top:15px;"> Bienvenido: <span class="glyphicon glyphicon-user" aria-hidden="true"></span>&nbsp;&nbsp;<strong>{{  Auth::user()->name }}</strong>  </div>
					   @endif
					<div class="jumbotron jumbotron-fluid">
					
						 <!-- PERMITE INSERTAR CONTENIDO VARIABLE DE CADA PÁGINA-->

						 <div style="clear:both"> @yield('contenido')	</div>
					</div>
   	    </div>
	   	<footer class="footer-base panel-footer jumbotron">
        	<font color=#ffffff><center>&copy; LATICS - DAMC-UJAT 2015 - 2023 - Todos los Derechos Reservados</center></font>
		</footer>
  </body>
</html>
