@extends('layouts.puente')
@section('title', 'Puente DE')



@section('title-active', 'active-menu')

@section('content')

@include('partials/menu')

<div class="after-menu"></div>

@include('partials/home/video')

@include('partials/home/instances')

@include('partials/home/banner')

@include('partials/home/columns')

@include('partials/footer')


@endsection