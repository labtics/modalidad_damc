<link rel="stylesheet" href="{{asset('css/menu.css')}}">
<link rel="stylesheet" href="{{asset('css/animation.css')}}">


<!DOCTYPE html>
<html lang="en">
<head>

</head>
<body>

	<nav class="nav">
		<ul>
			@guest
			<li>
				<a href="{{ url('modalidad/inicio') }}"><span class="glyphicon glyphicon-home" style="font-size: 1.6em"></span><br>Inicio</a>
			</li>
			<li>
				<a href="{{ url('modalidad/registrar') }}"><span class="glyphicon glyphicon-list-alt" style="font-size: 1.6em"></span><br> Registrar Modalidad</a>
			</li>
			@endguest
			@auth
			<li>
				<a href="{{ url('modalidad/buscar-egresado') }}"><span class="glyphicon glyphicon-search" style="font-size: 1.6em"></span><br>Búscar Egresado</a>
			</li>
			<li>
				<a href="{{ url('modalidad/consultar/descargar') }}"><span class="glyphicon glyphicon-download-alt" style="font-size: 1.6em"></span><br>Descargar Datos</a>
			</li>
			<li>
				<a href="{{ url('modalidad/estadistica') }}"><span class="glyphicon glyphicon-stats" style="font-size: 1.6em"></span><br>Estadísticas</a>
			</li>
			@endauth
			<li>
				<a href="{{ url('modalidad/consultar/requerimientos') }}"><span class="glyphicon glyphicon-eye-open" style="font-size: 1.6em"></span><br>Ver Requerimientos</a>
			</li>
            <li>
				<a href="{{ url('modalidad/tipos-modalidades') }}"><span class="glyphicon glyphicon-book" style="font-size: 1.6em"></span><br>Modalidades</a>
			</li>
			@guest
			<li>
				<a href="{{ url('modalidad/recursos') }}"><span class="glyphicon glyphicon-folder-open" style="font-size: 1.6em"></span><br>Recursos</a>
			</li>
			<li>
				<a href="{{ url('modalidad/contacto') }}"><span class="glyphicon glyphicon-phone" style="font-size: 1.6em"></span><br>Contacto</a>
			</li>
			<li>
				<a href="{{ url('modalidad/login') }}"><span class="glyphicon glyphicon-user" style="font-size: 1.6em"></span><br>Iniciar Sesión</a>
			</li>
			<li>
				<a href="{{ url('modalidad/registro') }}"><span class="glyphicon glyphicon-plus-sign" style="font-size: 1.6em"></span><br>Registro</a>
			</li>
			@endguest
			@auth
			<li>
				<form action="{{route('cerrar_sesion')}}" method="post">
				@csrf
					<a href="#" onclick="this.closest('form').submit()"><span class="glyphicon glyphicon-off" style="font-size: 1.6em"></span><br>Cerrar Sesión</a>
					
				</form>
			</li>
			@endauth
		</ul>
	</nav>
</body>
</html>