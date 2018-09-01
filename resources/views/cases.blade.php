
@extends('layouts.puente')
@section('title', 'PDE | '.$instance->name)

@section('content')

@include('partials/menu')

<section class="header-provider">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <img class="case-image" src="{{ $instance->images()->first()->getUrlAttribute() }}">
                <div class="middle-case">
                        <div class="text-case">{{ $instance->description }}</div>
                </div>
            </div>
            <div class="col-md-4">
                <img class="provider-image" src="{{ $provider->logo }}">
                <div class="middle-provider-case">
                        <div class="text-provider-case">{{ $provider->name }}</div>
                </div>
                <a href="{{ route('provider', $provider->id) }}" class="btn btn-danger case-btn">Ver empresa</a>
            </div>
        </div>
    </div>
</section>

<section class="case-description mt-4">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <p class="text-muted">Caso de diseño en la industria</p>
                <h3>{{ ucfirst($instance->name) }}</h3>
                <p>{{ $instance->long_description }}</p>
            </div>
            <div class="col-md-4">
                <h5>El diseño mejora significativamente la rentabilidad de los negocios</h5>
                <p class="text-muted">El viaje Puente Diseño Empresa es una herramienta que te ayudará a descubrir qué nivel de diseño tiene tu empresa, te guiará en cómo puedes integrar diseño y qué tipo de diseño es el indicado para tus desafíos.</p>
                <a href="#" class="btn btn-danger case-btn">Evalúa a tu empresa hoy</a>
            </div>
        </div>
    </div>
</section>

<section class="case-tags mt-4">
    <div class="container">
        <div class="row">
            <div class="col-md-8">

            </div>
            <div class="col-md-4">
                <h5>Tags</h5>
            </div>
        </div>
    </div>
</section>

<section class="case-related">
    <div class="container">
        <h4>Casos similares</h4>
        <div class="row">

        </div>
    </div>
</section>


@include('partials/footer')
