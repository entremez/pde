
@extends('layouts.puente')
@section('title', 'PDE | '.$provider->name)

@section('content')

@include('partials/menu')


<div class="after-menu"></div>

<section class="mt-5">
    <div class="col-md-10 offset-md-1">
        <div class="mb-2" style="display: {{ !$provider->approved ? '':'none' }}">
            <small>*Proveedor pendiente de aprobación.</small>
        </div>
        <div class="mb-4" style="display: {{ $provider->hasComments() ? '':'none' }}">
            <small>*Dejó observaciones a este proveedor.</small>
        </div>
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
                <div class="image-container">
                    <img class="w-100" src="{{ $provider->imagen_logo }}">
                </div>
                <button id="provider-btn" data-id="{{ $provider->id }}" class="btn btn-danger w-100">Ver contacto</button>
                <div class="provider-contact">
                    <div class="row text-left">
                        <div class="col-md-11 d-flex">
                            <div>   
                                <img src="{{ asset('images/bp_mail.svg') }}" width="30px"  class="mr-icon noselect">
                            </div>
                            <div>{{ $provider->contact_email }}</div>
                        </div>
                    </div>
                    <div class="row text-left">
                        <div class="col-md-11"><img src="{{ asset('images/bp_phone.svg') }}" width="30px"  class="mr-icon noselect">{{ $provider->phone }}</div>
                    </div>
                    <div class="row text-left">
                        <div class="col-md-11"><img src="{{ asset('images/bp_web.svg') }}" width="30px" class="mr-icon noselect">{{ $provider->web }}</div>
                    </div>
                    <div class="row text-left">
                        <div class="col-md-11 d-flex">
                            <div>   
                                <i class="fas fa-map-marker-alt mr-icon" style="font-size: 1.3rem;padding-left: .5rem;padding-right: .4rem;padding-top: .3rem;"></i>
                            </div>
                            <div>{{ $provider->address() }}</div>
                        </div>
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


@if($cases->count() > 0)
    <div class="col-md-10 offset-md-1 section">
        <div class="section-title">
            <p class="mt-0"><span class="first-color">Más Casos de diseño de</span> <span class="secondary-color">{{ $provider->name }}</span></p>
        </div>

        @include('partials/instances')

    </div>
@endif

@include('partials/footer')

@endsection
