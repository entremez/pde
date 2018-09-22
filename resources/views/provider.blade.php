
@extends('layouts.puente')
@section('title', 'PDE | '.$provider->name)

@section('content')

@include('partials/menu')


<div class="after-menu"></div>

<section>
    <div class="col-md-10 offset-md-1">
        <div class="row">
            <div class="col-md-9">
                
                <div class="provider-name">
                    <h3>{{ $provider->name }}</h3>
                </div>



                <div class="provider-subtitle">
                    @foreach($service as $s)
                    <span class="badge badge-info">{{ $s->name }}</span>
                    @endforeach
                </div>


                <div class="provider-description pt-3">
                    {{ $provider->long_description }}
                </div>
            </div>
            <div class="col-md-3">
                <img class="image-container w-100" src="{{ $provider->logo }}">
                <a href="#" data-id="{{ $provider->id }}" class="btn btn-danger provider-btn">Contacto</a>
                <div class="provider-contact">
                    <div class="row text-left">
                        <div class="col-md-11"><p>{{ $provider->email }}</p></div>
                    </div>
                    <div class="row text-left">
                        <div class="col-md-11"><p>{{ $provider->phone }}</p></div>
                    </div>
                    <div class="row text-left">
                        <div class="col-md-11"><p>{{ Rut::parse($provider->rut."-".$provider->dv_rut)->format()}}</p></div>
                    </div>
                    <div class="row text-left">
                        <div class="col-md-11"><p>{{ $provider->address }}</p></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<form method="post" action="{{ route('provider-counter', ':PROVIDER_ID') }}" id="form-counter">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <input type="hidden" name="counter_id" value="{{ $counterId }}">
</form>

<section class="provider-cases mt-4">
    <div class="container">
        <h3>Más casos de {{ $provider->name }}</h3>
        @include('partials/instances')
    </div>
</section>

@include('partials/footer')
