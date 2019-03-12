
@extends('layouts.puente')
@section('title', 'PDE | '.$instance->name)

@section('headers')
<meta property="og:title" content="PDE | {{$instance->name}}" />
<meta property="og:image" content="{{url($instance->image)}}" />
<meta property="og:type" content="website" />

@endsection

@section('content')

@include('partials/menu')


<div class="after-menu"></div>

    <div class="col-md-10 offset-md-1 mt-5 section">
            <div class="row">
                <div class="col-md-9">
                    <img class="image-container image-case" style="background-image: linear-gradient(0deg, rgba(255,255,255,0) 15%, rgba(0,0,0,0.4995040252429097) 33%, rgba(0,0,0,0.502305145691089) 50%, rgba(0,0,0,0.4995040252429097) 67%, rgba(255,255,255,0) 85%), url('{{ url($instance->image) }}')">
                    <div class="middle-case">
                            <div class="text-case">{{ $instance->quantity}} {{ $instance->unit}} {{$instance->sentence }}</div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="image-container center-img">
                        <img class="w-100" src="{{ url($provider->imagen_logo) }}">
                    </div>
                    <a href="{{ route('provider', $provider->id) }}" class="btn btn-danger w-100 provider-btn">Ver proveedor de diseño</a>
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
                    <div class="company-logo-container">
                        <div class="company-logo">
                            <img class="w-100" src="{{ $instance->image_company }}">
                        </div>
                    </div><br>
                    <p class="text-center">"{{ $instance->quote }}"</p>
                </div>
            </div>
            <div class="row"> 
                <div class="col">                   
                    <div class="btn btn-danger  mt-4">
                        Conozca el aporte del diseño en su empresa
                    </div>
                </div>
            </div>
            <div class="row mt-5"> 
                <div class="col">                   
                    <div class="text-muted font-weight-bold">
                        Comparte el caso
                    </div>
                    <div class="share">
                        <i class="fab fa-facebook-square"></i>
                        <i class="fab fa-twitter-square"></i>
                        <i class="fab fa-linkedin"></i>
                    </div>
                </div>
            </div>



        <section class="case-related">

                <h4 class="mt-4 mb-4">Casos similares</h4>

        @include('partials/instances')


        </section>

    </div>




@include('partials/footer')
@endsection