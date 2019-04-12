
@extends('layouts.puente')
@section('title', 'PDE | Error 404')

@section('content')

@include('partials/menu')


<div class="after-menu"></div>
<div style="margin: 0 auto">
	<img class="w-100" src="{{ asset('images/500.png') }}" alt="error500">
	
</div>
<p class="text-center errorNumber">Ocurrio un error en nuestros servidores.<br>(error 500)</p>

@include('partials/footer')
@endsection