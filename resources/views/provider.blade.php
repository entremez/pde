
@extends('layouts.puente')
@section('title', 'PDE | '.$provider->name)

@section('content')

@include('partials/menu')


<div class="after-menu"></div>

<section class="mt-5">
    <div class="col-md-10 offset-md-1">
        <div class="row">
            <div class="col-md-9">
                
                <div class="provider-name text-left">
                    <h3>{{ $provider->name }}</h3>
                </div>



                <div class="provider-subtitle">
                    @foreach($service as $s)
                    <a class="badge badge-success" href="{{ route('providers-list-filtered', $s->id)}}">{{ $s->name }}</a>
                    @endforeach
                </div>


                <div class="provider-description pt-3">
                    {{ $provider->long_description }}
                </div>
            </div>
            <div class="col-md-3">
                <img class="image-container w-100" src="{{ $provider->imagen_logo }}">
                <button id="provider-btn" data-id="{{ $provider->id }}" class="btn btn-danger w-100"> Contacto</button>
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

<div class="col-md-10 offset-md-1 section">
    <div class="section-title">
        <p class="mt-0"><span class="first-color">Más Casos de diseño de</span> <span class="secondary-color">{{ $provider->name }}</span></p>
    </div>

    @include('partials/instances')

</div>

@include('partials/footer')

@endsection
