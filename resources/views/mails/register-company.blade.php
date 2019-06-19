<h2>Hola!</h2>
<p>Gracias por inscribirte en el Puente Diseño-Empresa, la plataforma que permite mejorar los negocios a través del diseño.</p>
<p>Entra al siguiente link, confirma tu contraseña y auto-evalúa a tu empresa para saber cómo puedes hacerlo.</p>

<div style="text-align: center">
	<a style="
		background:    #e7004b;
		border-radius: 4px;
		padding:       8px 20px;
		color:         #ffffff;
		display:       inline-block;
		text-align:    center;
		text-decoration: none" href="{{ secure_url(route('new-company',[$token])) }}">Ingresar acá</a>
</div>



@include('mails/signature')
<hr>
<small>Si tiene problemas para hacer clic en el botón , copie y pegue la siguiente URL en su navegador web: {{ secure_url(route('new-company',[$token])) }}</small>

<br>