
@extends('layouts.puente')
@section('title', 'PDE | Error 404')

@section('content')

@include('partials/menu')


<div class="after-menu"></div>
<div style="margin: 0 auto">
	<img class="w-100" src="{{ asset('images/404.png') }}" alt="error404">
</div>

@include('partials/footer')
@endsection