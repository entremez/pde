
<body>
	<div class="row">
		<img src="http://box5677.temp.domains/~yebizbmy/images/logo.png" class="mx-auto d-block" alt="Puente Diseño Empresa Logo">
	</div>
	<div class="row">
		<p>Hola {{ $provider->name }}, te has registrado en la plataforma PDE ... explicación</p>
		<h3>Datos de registro</h3>
		<ul>
			<li>{{ Rut::parse($provider->rut."-".$provider->dv_rut)->format()}}</li>
			<li>{{ $provider->address() }}</li>
			<li>{{ $provider->phone }}</li>
			<li>{{ $provider->web }}</li>
			<li>{{ $provider->long_description }}</li>
		</ul>
	</div>
</body>