
@extends('layouts.puente')
@section('title', 'Recursos')
@section('title-resources', 'active-menu')

@section('content')

@include('partials/menu')

<div class="after-menu"></div>
<div class="contenedor mb-5">
<img src="{{url('/banners/4.jpg')}}" class="w-100">
  <div class="centrado">Recursos</div>
</div> 

<div class="col-md-10 offset-md-1 mt-5">

</div>

@include('partials/footer')

@endsection

