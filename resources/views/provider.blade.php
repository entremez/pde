
@extends('layouts.puente')
@section('title', 'PDE | '.$provider->name)

@section('content')

@include('partials/menu')

<section class="header-provider">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="provider-subtitle">
                    @foreach($service as $s)
                    <span class="badge badge-info">{{ $s->name }}</span>
                    @endforeach
                </div>
                <div class="provider-name">
                    <h3>{{ $provider->name }}</h3>
                </div>
                <div class="provider-description">
                    {{ $provider->long_description }}
                </div>

                <div class="provider-contact">
                    <h3>Contacto</h3>
                    <div class="row text-left">
                        <div class="col-md-1"><i class="material-icons">mail_outline</i></div>
                        <div class="col-md-11"><p>{{ $provider->email }}</p></div>
                    </div>
                    <div class="row text-left">
                        <div class="col-md-1"><i class="material-icons">phone</i></div>
                        <div class="col-md-11"><p>{{ $provider->phone }}</p></div>
                    </div>
                    <div class="row text-left">
                        <div class="col-md-1"><i class="material-icons">fingerprint</i></div>
                        <div class="col-md-11"><p>{{ Rut::parse($provider->rut."-".$provider->dv_rut)->format()}}</p></div>
                    </div>
                    <div class="row text-left">
                        <div class="col-md-1"><i class="material-icons">location_on</i></div>
                        <div class="col-md-11"><p>{{ $provider->address }}</p></div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <img class="provider-image" src="{{ $provider->logo }}">
                <a href="#" data-id="{{ $provider->id }}" class="btn btn-danger provider-btn">Contacto</a>
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
