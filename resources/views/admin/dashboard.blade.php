
@extends('layouts.puente')
@section('title', 'PDE | Dashboard Admin')

@section('content')

@include('partials/menu')
<div class="after-menu"></div>
<div>Casos totales: {{ $instances->count()}}</div>
<div>Casos aprobados: {{ $instancesApproved->count()}}</div>
<div>Casos en buffer: {{ $intancesBuffered->count()}}</div>

@include('partials/footer')

@endsection
