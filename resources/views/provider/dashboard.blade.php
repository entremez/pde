@extends('layouts.puente')
@section('title', 'PDE | Dashboard')

@section('content')

@include('partials/menu')
<div class="after-menu"></div>

<div class="col-md-10 offset-md-1">
    <div class="row mt-5">
        <div class="col-md-9 hidden">
            <h3 class="pb-4">Tus casos de éxito</h3>
                <div class="row">

<input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
<input type="hidden" id="delete" value="{{ route('delete.case')}}">

                    @foreach($instances as $instance)
                    <div class="col-md-4 col-sm-6 instance-dashboard">
                        <div class="service">
                            <a href="{{ route('case', $instance->id) }}">
                                    <div class="corner dashboard">{{ $instance->classification->classification }}</div>
                                <div class="image-container dashboard" style="background-image: linear-gradient(to bottom, rgba(0,0,0,0) 17%,rgba(0,0,0,0.54) 72%,rgba(0,0,0,0.65) 83%,rgba(0,0,0,0.65) 98%), url('{{url($instance->image)}}')">

                                <div class="container"> 
                                        <div class="row-c">
                                        <div class="div2">{{ $instance->quantity}}</div>
                                        <div class="div1"><div class="porcentaje">{{ $instance->unit}}</div><br>{{ $instance->sentence }}</div>
                                        </div>
                                </div>
                                        
                                </div>
                            </a>

                                <div class="middle">
                                    <div class="edit">
                                        <a href="{{route('case', $instance)}}"><i class="fas fa-search-plus link"></i></a>
                                        <a href="{{route('cases.edit', $instance)}}"><i class="fas fa-edit link"></i></a>
                                        <a href="#" ><i class="far fa-trash-alt link delete"  data-id="{{ $instance->id}}"></i></a>

                                    </div>
                                </div>
                        </div>
                        <span class="overlay"></span>
                    </div>
                    @endforeach

                    @if(config('app.max_cases')-$instances->count() != 0 )
                    <div class="col-md-4 col-sm-6">
                        <a href="{{route('cases.create')}}" class="link">
                            <div class="service add">
                            <div class="image-container"><span class="plus-img">+</span>
                            </div>
                        </div>
                            </a>
                    </div>
                    @endif
                </div>
        </div>

        


        <div class="col-md-3 provider-data">
            <div class="arrow-dashboard"><a href="{{route('provider.settings')}}"><i class="fas fa-arrow-left"></i></a></div>
                <img src="{{ $data->imagen_logo }}" class="rounded mx-auto d-block img-fluid provider-logo"  alt="provider logo">

            
                <h1>{{ $data->name }}</h1>
            
                        @foreach($services as $service)
                        <span class="badge badge-success">
                            {{ $service->service()->get()->first()->name }}
                        </span>
                        @endforeach

                <hr>
                <p>{{ $user->email }}</p>
                <hr>
                <p>{{ $data->phone }}</p>
                <hr>
                <p>{{ Rut::parse($data->rut."-".$data->dv_rut)->format()}}</p>
                <hr>
                <p>{{ $data->address }}</p>
                <hr>
                <p>{{ $data->web }}</p>
                <hr>
                <p>{{ $data->long_description }}</p>
                <hr>
                <p>Caracterización de profesionales de diseño</p>
                    <p>Técnicos: {{ $data->team->tecnics }} </p>
                    <p>Profesionales: {{ $data->team->professionals }} </p>
                    <p>Masters: {{ $data->team->masters }} </p>
                    <p>Doctores: {{ $data->team->doctors }} </p>

            
        </div>


</div>
</div>


@include('partials/footer')

@endsection
