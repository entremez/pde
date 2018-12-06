
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

<section>
    <div class="col-md-10 offset-md-1">
        <section>
            <div class="row">
                <div class="col-md-9">
                    <img class="image-container image-case" src="{{ $instance->image }}">
                    <div class="middle-case">
                            <div class="text-case">{{ $instance->quantity}} {{ $instance->unit}} {{$instance->sentence }}</div>
                    </div>
                </div>
                <div class="col-md-3">
                    <img class="image-container w-100" src="{{ $provider->logo }}">
                    <a href="{{ route('provider', $provider->id) }}" class="btn btn-danger w-100 btn-company">Ver proveedor de diseño</a>
                </div>
            </div>
        </section>
        <section class="mt-4">
            <div class="row">
                <div class="col-md-12">
                <p class="text-muted">Caso de diseño en la industria</p></div>
            </div>
            <div class="row">
                <div class="col-md-9">
                    <h3>{{ ucfirst($instance->name) }}</h3>
                    <p>{{ $instance->long_description }}</p>

                    
                    <div class="text-muted mt-5 mb-2 font-weight-bold">Tags</div>
                    <div class="tags"> 
                        @foreach($instance->tags() as $tag)
                        <div class="text-muted">{{ $tag }}</div>
                        @endforeach
                    </div>
                    <div class="text-muted mt-5 font-weight-bold">
                        Comparte el caso
                    </div>
                    <div class="share">
                        <i class="fab fa-facebook-square"></i>
                        <i class="fab fa-twitter-square"></i>
                        <i class="fab fa-linkedin"></i>

                    </div>
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
        </section>


        <section class="case-related">

                <h4 class="mt-4 mb-4">Casos similares</h4>

        @include('partials/instances')


        </section>

    </div>
</section>

@include('partials/footer')
@endsection