
@extends('layouts.puente')
@section('title', 'PDE | Dashboard')

@section('content')

@include('partials/menu')
<div class="after-menu"></div>

<div class="survey-container">
    @include('survey')
</div>

@include('partials/footer')

@endsection


