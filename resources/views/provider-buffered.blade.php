
@extends('layouts.puente')
@section('title', 'PDE | '.$providerBuffered->name)

@section('content')

@include('partials/menu')


<div class="after-menu"></div>

<section class="mt-5">
    <div class="col-md-10 offset-md-1">
        <div class="mb-4" style="display: {{ !$provider->approved ? '':'none' }}">
                    <small>*Proveedor pendiente de aprobación.</small>
            </div>
        <div class="row">
            <div class="col-md-6">
                
                <div class="provider-name text-left">
                    <h3>{{ $providerBuffered->name }}</h3>
                </div>


                @if($providerBuffered->equalServices($provider))
                <div class="provider-subtitle">
                    @foreach($service as $s)
                    <a class="badge badge-success" href="{{ route('providers-list-filtered', $s->id)}}">{{ $s->name }}</a>
                    @endforeach
                </div>
                @else

                    @if($providerBuffered->servicesMaintained($provider)->count() != 0)
                    Servicios que se mantienen
                    <div class="provider-subtitle">
                        @foreach($providerBuffered->servicesMaintained($provider) as $s)
                        <a class="badge badge-success" href="{{ route('providers-list-filtered', $s->id)}}">{{ $s->name }}</a>
                        @endforeach
                    </div>
                    @endif

                    @if($providerBuffered->servicesRemoved($provider)->count() != 0)
                    Servicios eliminados
                    <div class="provider-subtitle">
                        @foreach($providerBuffered->servicesRemoved($provider) as $s)
                        <a class="badge badge-success" href="{{ route('providers-list-filtered', $s->id)}}">{{ $s->name }}</a>
                        @endforeach
                    </div>
                    @endif

                    @if($providerBuffered->servicesAdded($provider)->count() != 0)
                    Servicios agregados
                    <div class="provider-subtitle">
                        @foreach($providerBuffered->servicesAdded($provider) as $s)
                        <a class="badge badge-success" href="{{ route('providers-list-filtered', $s->id)}}">{{ $s->name }}</a>
                        @endforeach
                    </div>
                    @endif
                @endif
            </div>

            @if($providerBuffered->imagen_logo ==  $provider->imagen_logo)
            <div class="col-md-3">
            </div>
            <div class="col-md-3">
                <img class="image-container w-100" src="{{ $provider->imagen_logo }}">
            </div>
            @else
            <div class="col-md-3">
                <p>Logo original</p>
                <img class="image-container w-100" src="{{ $provider->imagen_logo }}">
            </div>
            <div class="col-md-3">
                <p>Nuevo logo</p>
                <img class="image-container w-100" src="{{ $providerBuffered->imagen_logo }}">
            </div>
            @endif
        </div>
        <div class="row">
            <div class="col">
                <h4 class="mt-2">Descripción</h4>
                @if($providerBuffered->long_description ==  $provider->long_description)
                    <div class="provider-description">
                        {{ $providerBuffered->long_description }}
                    </div>
                @else
                    <p>Descripción inicial <br>
                        {{ $provider->long_description }}</p>

                    <p class="mt-3">Descripción modificada <br>
                        {{ $providerBuffered->long_description }}</p>
                @endif

                <h4 class="mt-4">Telefono</h4>
                @if($providerBuffered->phone == $provider->phone)
                    <div class="row text-left">
                        <div class="col-md-11"><p>{{ $providerBuffered->phone }}</p></div>
                    </div>
                @else
                    <p>Teléfono inicial <br>
                        {{ $provider->phone }}</p>
                    <p class="mt-3">Teléfono modificado <br> {{ $providerBuffered->phone }}</p>

                @endif

                <h4 class="mt-4">Rut</h4>
                @if($providerBuffered->rut == $provider->rut))

                    <p>{{ Rut::parse($providerBuffered->rut."-".$providerBuffered->dv_rut)->format()}}
                    </p>
                @else                    
                    <p>
                        Rut inicial <br>
                        {{ Rut::parse($provider->rut."-".$provider->dv_rut)->format()}}
                    </p>
                    <p>
                        Rut modificado <br>
                        {{ Rut::parse($providerBuffered->rut."-".$providerBuffered->dv_rut)->format()}}
                    </p>
                @endif

                <h4 class="mt-4">Dirección</h4>
                @if($providerBuffered->address() == $provider->address())
                    <p>{{ $provider->address() }}</p>
                @else
                    <p>Dirección inicial <br>
                        {{ $provider->address() }}</p>
                    <p class="mt-3">
                        Dirección modificada <br> 
                        {{ $providerBuffered->address() }}</p>                    
                @endif

                <h4 class="mt-4">Web</h4>
                @if($providerBuffered->web == $provider->web)
                    <p>{{ $provider->web }}</p>
                @else
                    <p>Dirección inicial <br>
                        {{ $provider->web }}</p>
                    <p class="mt-3">
                        Dirección modificada <br> 
                        {{ $providerBuffered->web }}</p>                    
                @endif

                <h4 class="mt-4">Regiones de funcionamiento</h4>
                    @if($providerBuffered->equalRegions($provider))
                        @foreach($provider->getRegions() as $region)
                            {{ $region }} <br>
                        @endforeach
                    </div>
                    @else

                        @if($providerBuffered->regionMaintained($provider)->count() != 0)
                        <p>Regiones que se mantienen</p> 
                            <ul>
                            @foreach($providerBuffered->regionMaintained($provider) as $region)
                                <li>{{ $region }}</li>
                            @endforeach
                            </ul>
                        @endif

                        @if($providerBuffered->regionRemoved($provider)->count() != 0)
                        <p>Regiones eliminadas</p>
                        <ul>
                            @foreach($providerBuffered->regionRemoved($provider) as $region)
                                <li>{{ $region }}</li>
                            @endforeach
                        </ul>
                        @endif

                        @if($providerBuffered->regionAdded($provider)->count() != 0)
                        <p>Regiones agregadas</p>
                        <ul>
                            @foreach($providerBuffered->regionAdded($provider) as $region)
                               <li>{{ $region }}</li>
                            @endforeach
                        </ul>
                        @endif
                    @endif
            </div>
        </div>
    </div>
</section>


@include('partials/footer')

@endsection
