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
                  <div class="col display-mobile">
                    <video controls class="w-100">
                          <source src="{{ asset('images/video_bien_publico.mp4') }}" type="video/mp4">
                        Your browser does not support the video tag.
                    </video>
                  </div>
                  <div class="col-md-6 left-column dffdcjcsb">

                    <div class="margin-x margin-top-3">
                        <h2>El diseño mejora significativamente la rentabilidad de los negocios</h2>
                        <p>El viaje Puente Diseño Empresa es una herramienta que te ayudará a descubrir qué nivel de diseño tiene tu empresa, te guiará en cómo puedes integrar diseño y qué tipo de diseño es el indicado para tus desafíos.</p>
                    </div>
                    <div class="margin-bottom-3">
                        @if(auth()->check())
                            <a class="btn btn-danger w-100 link" id="travelOrRegister" data-type="{{ auth()->user()->needTravel() ? 'travel':'register' }}" style="margin-bottom: 5px" href="/dashboard">
                                {{ auth()->user()->evaluateText()}}
                            </a>
                        @else
                            <a class="btn btn-danger w-100 link" id="travelOrRegister" data-type="register" style="margin-bottom: 5px">    
                                Regístrate para evaluar tu empresa
                            </a>
                        @endif
                    </div>
                </div>
                <div class="col-md-6 display-none">
                    <video controls class="w-100">
                          <source src="{{ asset('images/video_bien_publico.mp4') }}" type="video/mp4">
                        Your browser does not support the video tag.
                    </video>
                </div>
            </div>
        </div>
</section>


<div class="modal fade login" id="registerTravel" tabindex="-1" role="dialog" aria-labelledby="loginModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content bigModal">
      <div class="modal-body login">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <div class="col-md-12">
          <div class="row login">
            <div class="col-md-6 l-margin">
              <h3 class="text-center pb-4">Iniciar sesión</h3>

              @include('auth/travel-login')

            </div>
            <div class="col-md-6 r-margin">
              <h3 class="text-center pb-4">Registrarse</h3>

              @include('auth/travel-register')

            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>


@include('partials/footer')

@endsection