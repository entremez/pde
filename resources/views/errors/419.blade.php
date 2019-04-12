
@extends('layouts.puente')
@section('title', 'PDE | Error 404')

@section('content')

@include('partials/menu')


<div class="after-menu"></div>
<div style="margin: 0 auto">
	<img class="w-100" src="{{ asset('images/404.png') }}" alt="error404">
	<a href="{{ route('provider.register') }}" class="btn btn-danger">Presiona acá para reingresar</a>
</div>

@include('partials/footer')
@endsection