@extends('layouts.puente')
@section('title', 'PDE | Dashboard')

@section('content')

@include('partials/menu')
<div class="after-menu"></div>

<div class="col-md-10 offset-md-1">
    <div class="row mt-5">
        <div class="col-md-9">
            <h3>Sube tus casos de éxito</h3>
                <div class="row">
                    <div class="col-md-4">
                        
                    </div>
                    <div class="col-md-4">
                        
                    </div>
                    <div class="col-md-4"></div>
                </div>
        </div>
        


        <div class="col-md-3 provider-data">

                <img src="{{ $data->url }}" class="rounded mx-auto d-block img-fluid provider-logo"  alt="provider logo">

            
                <h1>{{ $data->name }}</h1>
            
                        @foreach($services as $service)
                        <span class="badge badge-success">
                            {{ $service->service()->get()->first()->name }}
                        </span>
                        @endforeach

                <p>{{ $user->email }}</p>

                <p>{{ $phone }}</p>

                <p>{{ Rut::parse($data->rut."-".$data->dv_rut)->format()}}</p>

                <p>{{ $data->address }}</p>
                <p>{{ $data->web }}</p>
                <p>{{ $data->long_description }}</p>
                <p>Miembros del equipo</p>
                        @foreach($data->team()->get() as $team)
                            {{ $team->name }} - {{ $team->profession }}
                        @endforeach
            
        </div>


</div>
</div>

@include('partials/footer')

@endsection
