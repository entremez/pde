@extends('layouts.puente')
@section('title', 'Evalúa tu empresa')
@section('title-evaluate', 'active-menu')

@section('content')

@include('partials/menu')

<div class="after-menu"></div>
<div class="contenedor mb-5">
<img src="{{url('/banners/5.jpg')}}" class="w-100">
  <div class="centrado">Evalúa y mejora el diseño en tu empresa</div>
</div> 


<section class="columns-evaluate mt-5">
        <div class="col-md-10 offset-md-1">
            <div class="row">
                <div class="col-md-6 left-column">
                    <h2>El diseño mejora significativamente la rentabilidad de los negocios</h2>
                    <p>El viaje Puente Diseño Empresa es una herramienta que te ayudará a descubrir qué nivel de diseño tiene tu empresa, te guiará en cómo puedes integrar diseño y qué tipo de diseño es el indicado para tus desafíos.</p>
                    <div class="button-bottom">
                        <button class="btn btn-danger btn-block">Regístrate para evaluar tu empresa</button>
                    </div>
                </div>
                <div class="col-md-6">
                <iframe src="https://player.vimeo.com/video/33373857" width="600" height="360" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>

                </div>
            </div>
        </div>
</section>


@include('partials/footer')

@endsection