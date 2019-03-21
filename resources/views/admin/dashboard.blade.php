
@extends('layouts.puente')
@section('title', 'PDE | Dashboard Admin')

@section('content')

@include('partials/menu')
<div class="mt-5"></div>

<div class="col-md-10 offset-md-1 section">
    <h3>Hola <span>{{ auth()->user()->instance()->name }}</span>, bienvenido a tu escritorio</h3>

	@include('admin/providers_to_approve')
	@include('admin/instances_to_approve')
	@include('admin/providers_approved')
	@include('admin/instances_approved')
	@include('admin/instances_in_buffer')
	@include('admin/providers_in_buffer')
</div>


@include('partials/footer')

@endsection
