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


<section class="columns-evaluate">
        <div class="col-md-10 offset-md-1 section">
            <div class="row">
                    <div class="col-md-6 left-column dffdcjcsb">

                    <div>
                        <h2>El diseño mejora significativamente la rentabilidad de los negocios</h2>
                        <p>El viaje Puente Diseño Empresa es una herramienta que te ayudará a descubrir qué nivel de diseño tiene tu empresa, te guiará en cómo puedes integrar diseño y qué tipo de diseño es el indicado para tus desafíos.</p>
</div>
<div>
                            <button class="btn btn-danger w-100" style="margin-bottom: 5px">Regístrate para evaluar tu empresa</button>
                        </div>

                </div>
                    <div class="col-md-6">
                    <video controls class="w-100">
                          <source src="{{ asset('images/video_bien_publico.mp4') }}" type="video/mp4">
                        Your browser does not support the video tag.
                    </video>

                    </div>
            </div>
        </div>
</section>


@include('partials/footer')

@endsection