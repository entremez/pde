<body>
	<div class="container">
		<div class="row ">
			<img src="http://box5677.temp.domains/~yebizbmy/images/logo.png">
		</div>
		<div class="row">
			<div class="col">
				<p>Verifica tu mail haciendo <a href="{{ route('verification' , [  'id' => $user->id , 'token' => $token]) }}">Click acá</a></p>
			</div>
		</div>
	</div>
</body>