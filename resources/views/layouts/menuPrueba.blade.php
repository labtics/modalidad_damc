<link rel="stylesheet" href="{{asset('css/menu.css')}}">

<!DOCTYPE html>
<html lang="en">
<head>

</head>
<body>

	<nav class="nav">
		<ul>
			@guest
			<li>
				<a href="{{ url('modalidad') }}">Inicio</a>
			</li>
			@endguest
			@auth
			<li>
				<a href="{{ url('modalidad/admin/panel') }}">Panel de Control</a>
			</li>

			<li>
				<a href="{{ url('modalidad/admin/graficos') }}">Estadísticas</a>
			</li>

			<li>
				<a href="{{ url('modalidad/admin/descargar') }}">Descargar</a>
			</li>
			@endauth
			<li>
				<a href="{{ url('modalidad/consulta') }}">Consultar Requerimientos</a>
			</li>
            <li>
				<a href="{{ url('modalidad/tipos') }}">Modalidades de Titulaciòn</a>
			</li>
			@guest
			<li>
				<a href="{{ url('modalidad/login') }}">Iniciar Sesión</a>
			</li>
			<li>
				<a href="{{ url('modalidad/registro') }}">Registro</a>
			</li>
			@endguest
			@auth
			<li>
				<form action="{{route('cerrar_sesion')}}" method="post">
				@csrf
					<a href="#" onclick="this.closest('form').submit()">Cerrar Sesión</a>
					
				</form>
			</li>
			@endauth
		</ul>
	</nav>
</body>
</html>