@extends('layouts.puente')
@section('title', 'PDE | '.$instance->name)

@section('content')

@include('partials/menu')


<div class="after-menu"></div>

    <div class="col-md-10 offset-md-1 mt-5 section">
            <small>*Caso pendiente de aprobación. Ver caso público <a href="{{ route('case', $original) }}" target="_blank">aquí.</a></small><br><br>
            <div class="row">
                <div class="col-md-9">
                    <img class="image-container image-case" style="background-image: linear-gradient(0deg, rgba(255,255,255,0) 15%, rgba(0,0,0,0.4995040252429097) 33%, rgba(0,0,0,0.502305145691089) 50%, rgba(0,0,0,0.4995040252429097) 67%, rgba(255,255,255,0) 85%), url('{{ url($instance->my_image) }}')">
                    <div class="middle-case">
                            <div class="text-case">{{ $instance->quantity}} {{ $instance->unit}} {{$instance->sentence }}</div>
                    </div>
                </div>
                <div class="col-md-3">

                            <img class="w-100" src="{{ $instance->image_company }}">
                    <br>
                    <p class="text-center mt-3">"{{ $instance->quote }}"</p>
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-md-12">
                <p class="text-muted">Caso de diseño en la industria</p></div>
            </div>
            <div class="row">
                <div class="col-md-9">
                    <h3>{{ ucfirst($instance->name) }}</h3>
                    <p>{{ $instance->long_description }}</p>

                    
                    <div class="text-muted mt-5 mb-2 font-weight-bold">Etiquetas</div>

                        @foreach($instance->tags() as $tag)
                        <a href="{{ route('casesWithParameters', [$tag['key'], $tag['id']]) }}" class="badge badge-success">{{ $tag['name'] }}</a> 
                        @endforeach

                </div>
                <div class="col-md-3">
                    <p>Proveedor de diseño</p>
                    <div class="image-container center-img">
                        <img class="w-100" src="{{ url($provider->imagen_logo) }}" alt="{{ $provider->name }}">
                    </div>
                    <a href="{{ route('provider', $provider->id) }}" class="btn btn-danger w-100 provider-btn">Ver proveedor de diseño</a>
                </div>

            </div>
    </div>




@include('partials/footer')
@endsection