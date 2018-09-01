@extends('layouts.home')
@section('css')
<link rel="stylesheet" type="text/css" href="{{ asset('css/blank.css') }}">
@endsection

@section('content')
<div class="container">
<!--     <div class="container">
        <div class="row">
            <div class="col-md-6 offset-3 text-center">
                <h2>Casos</h2>
                <h4 class="text-justify">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                consequat.</h4>
            </div>
        </div>
    </div> -->
<h2 class="text-center">Casos de éxito</h2>
    <div class="container">
        <div class="row">
            @foreach($cases as $case)
            <div class="col-md-4 ">
                <div class="card">
                    <img class="card-img-top" src="{{ $case->featured_image }}" alt="Card image cap">
                    <div class="card-body">
                        @foreach($case->services as $services)
                                @foreach($services->services as $service)
                                <a href="{{ route('service',$service) }}">
                                    <span class="badge badge-success">
                                        {{ $service->name }}
                                    </span>
                                </a>
                                @endforeach
                        @endforeach
                        <h5 class="card-title">{{ ucfirst($case->name) }}</h5>
                        <p class="card-text">{{ $case->description }}</p>
                        <a href="{{ route('case', $case->id) }}" class="btn btn-primary text-center">Ver caso</a>
                    </div>

                </div>
                <br>
            </div>


            @endforeach
       </div>
       <div class="text-center"><a href="" class="btn btn-primary">Ver más</a></div>
    </div>
</div>

<div class="container text-center">
    <h2>¿Y tú, usas diseño?</h2>
    <a href="{{ route('travel') }}" class="btn btn-success">Viaje Puente Diseño Empresa</a>
</div>



@endsection