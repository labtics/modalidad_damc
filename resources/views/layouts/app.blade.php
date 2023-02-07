<!DOCTYPE html>
<html lang="es">

 <head>
	    <meta charset="utf-8">
	    <title>@yield('title', 'Default') Titulación</title>
	    
	    <link rel="stylesheet" href="{{asset('plugins/bootstrap/css/bootstrap.min.css')}}">
	    <link rel="stylesheet" href="{{asset('plugins/bootstrap/js/bootstrap.min.js')}}">
	    <link rel="stylesheet" href="{{asset('css/menu_barra_verde.css')}}">
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
   	    			<div class="jumbotron jumbotron-fluid">
						 @include('flash::message')
						 <!-- PERMITE INSERTAR CONTENIDO VARIABLE DE CADA PÁGINA-->
						 @yield('contenido')	
					</div>
   	    </div>
	   	<footer class="footer-base panel-footer jumbotron">
        	<font color=#ffffff><center>&copy; 2023 DAMC-UJAT Todos los Derechos Reservados</center></font>
		</footer>
  </body>
</html>
