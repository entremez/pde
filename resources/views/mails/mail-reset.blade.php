<h2>Hola!</h2>
<p>Está recibiendo este correo electrónico porque recibimos una solicitud de restablecimiento de contraseña para su cuenta.</p>
<br>
<div style="text-align: center">
	<a style="
		background:    #3d85c6;
		border-radius: 4px;
		padding:       8px 20px;
		color:         #ffffff;
		display:       inline-block;
		text-align:    center;
		text-decoration: none" href="{{ secure_url(route('password.reset',[$token])) }}">Reestablecer contraseña</a>
</div>
<br>
<p>Este enlace de restablecimiento de contraseña caducará en 60 minutos.</p>

<p>Si no solicitó un restablecimiento de contraseña, no es necesario realizar ninguna otra acción.</p>
@include('mails/signature')
<hr>
<small>Si tiene problemas para hacer clic en el botón "Restablecer contraseña", copie y pegue la siguiente URL en su navegador web: {{ secure_url(route('password.reset',[$token])) }}</small>

<br>