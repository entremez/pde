
@extends('layouts.puente')
@section('title', 'PDE | '.$instance->name)

@section('content')

@include('partials/menu')


<div class="after-menu"></div>

<section>
    <div class="col-md-10 offset-md-1">
        <section>
            <div class="row">
                <div class="col-md-9">
                    <img class="image-container image-case" src="https://picsum.photos/1000/400?image={{ $instance->id }}">
                    <div class="middle-case">
                            <div class="text-case">{{ $instance->percentage}}% {{$instance->result }}</div>
                    </div>
                </div>
                <div class="col-md-3">
                    <img class="image-container w-100" src="{{ $provider->logo }}">
                    <a href="{{ route('provider', $provider->id) }}" class="btn btn-danger w-100 btn-company">Ver empresa</a>
                </div>
            </div>
        </section>
        <section class="mt-4">
            <div class="row">
                <div class="col-md-9">
                    <p class="text-muted">Caso de diseño en la industria</p>
                    <h3>{{ ucfirst($instance->name) }}</h3>
                    <p>{{ $instance->long_description }}</p>

                    
                    <div class="text-muted mt-4 mb-2 font-weight-bold">Tags</div>
                    <div class="tags"> 

                        <div class="text-muted">Diseño para la creación de servicios</div>
                        <div class="text-muted">Diseño gráfico y de impresos</div>
                        <div class="text-muted">Diseño en estrategia de la organización</div>
                        <div class="text-muted">+ 3 años de antigüedad</div>
                        <div class="text-muted">Sector terciario</div>
                        <div class="text-muted">Empresa grande</div>
                        <div class="text-muted">Santiago  </div>
                    </div>
                    <div class="text-muted mt-4 font-weight-bold">
                        Comparte el caso
                    </div>
                    <div class="share">
                        <i class="fab fa-facebook-square"></i>
                        <i class="fab fa-twitter-square"></i>
                        <i class="fab fa-linkedin"></i>
                    </div>
                </div>
                <div class="col-md-3">
                    <h5>El diseño mejora significativamente la rentabilidad de los negocios</h5>
                    <p class="text-muted text-justify">El viaje Puente Diseño Empresa es una herramienta que te ayudará a descubrir qué nivel de diseño tiene tu empresa, te guiará en cómo puedes integrar diseño y qué tipo de diseño es el indicado para tus desafíos.</p>
                    <a href="#" class="btn btn-danger w-100 btn-evaluate">Evalúa a tu empresa hoy</a>
                </div>
            </div>
        </section>


        <section class="case-related">

                <h4 class="mt-4 mb-4">Casos similares</h4>

@include('partials/instances')


        </section>

    </div>
</section>

@include('partials/footer')
