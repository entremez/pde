@extends('layouts.puente')
@section('title', 'PDE | Equipo')

@section('content')

@include('partials/menu')

<div class="after-menu"></div>

<div class="contenedor mb-5">
<img src="{{url('/banners/3.jpg')}}" class="w-100">
  <div class="centrado">El proyecto Bien Público</div>
</div>

<div class="col-md-10 offset-md-1">
    <h3 class="mt-4">Ecosistema</h3>
    <img src="{{ asset('/images/ecosistema.png')}}" class="img-fluid" alt="ecosistema">

    <div id="team" class="mb-5"></div>
    <div class="mt-5">&nbsp;</div>
    <h3 class="mt-5">El equipo</h3>

    <div class="row mt-5">
        @foreach($team as $people)
            <div class="col-md-3">
                <p class="first-color team-name">{{$people->name}}</p>
                <div class="team-title">{{ $people->title }}</div>
            </div>
        @endforeach
    </div>
</div>



@include('partials/footer')
@endsection