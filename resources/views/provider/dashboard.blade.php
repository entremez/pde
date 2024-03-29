@extends('layouts.puente')
@section('title', 'PDE | Dashboard')

@section('content')

@include('partials/menu')


<div class="after-menu"></div>

<div class="col-md-10 offset-md-1">
    <h3 class="pt-5">Hola <span>{{ $personalData->name }}</span>, bienvenido a tu escritorio</h3>
    <div class="row mt-5">
        @include('provider/sidebar')
        <div class="col-md-9 hidden">
            <h4 class="pb-4">Casos en espera de aprobación para su publicación</h4>
                <div class="row">

                    <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
                    <input type="hidden" id="delete" value="{{ route('delete.case')}}">

                    @foreach($instances as $instance)
                        @if(!$instance->approved or $instance->isBuffered())
                            <div class="col-md-4 col-sm-6 instance-dashboard">
                                <div class="service">
                                    <a href="{{ $instance->isBuffered() ?   route('case.buffered', $instance) : route('case', $instance) }}" target="_blank">
                                            <div class="corner dashboard">{{ $instance->status ? $instance->corner_buffered :
                                            $instance->classification->classification }}</div>
                                        <div class="image-container dashboard" style="background-image: linear-gradient(to bottom, rgba(0,0,0,0) 17%,rgba(0,0,0,0.54) 72%,rgba(0,0,0,0.65) 83%,rgba(0,0,0,0.65) 98%), url('{{url($instance->my_image)}}')">

                                        <div class="container"> 
                                                <div class="row-c">
                                                <div class="div2">{{ $instance->quantity}}</div>
                                                <div class="div1">
                                                    <div class="porcentaje">{{ $instance->unit}}</div>
                                                    <div class="sentence">{{ $instance->sentence }}</div></div>
                                                </div>
                                        </div>
                                                
                                        </div>
                                    </a>

                                        <div class="middle">
                                            <div class="edit">
                                                <a href="{{ $instance->isBuffered() ? route('case.buffered', $instance) : route('case', $instance) }} " target="_blank"><i class="fas fa-search-plus link"></i></a>
                                                <a href="{{route('cases.edit', $instance)}}"><i class="fas fa-edit link"></i></a>
                                                <a href="#" ><i class="far fa-trash-alt link delete"  data-id="{{ $instance->id}}"></i></a>

                                            </div>
                                        </div>
                                </div>
                                <span class="overlay"></span>
                            </div>
                        @endif
                    @endforeach

                    @if(config('app.max_cases')-$instances->count() != 0 )
                    <div class="col-md-4 col-sm-6">
                        <a href="{{route('cases.create')}}" class="link">
                            <div class="service add">
                                    <img src="{{ asset('images/agregar_caso.png')}}" alt="Agregar caso" class="image-container">
                            </div>
                        </a>
                    </div>
                    @endif
                </div>
            <hr>
            <h4 class="pb-4">Casos publicados</h4> 
                <div class="row">

                    <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
                    <input type="hidden" id="delete" value="{{ route('delete.case')}}">

                    @foreach($instances as $instance)
                        @if($instance->approved && !$instance->isBuffered())
                            <div class="col-md-4 col-sm-6 instance-dashboard">
                                <div class="service">
                                    <a href="{{ route('case', $instance->id) }}">
                                            <div class="corner dashboard">{{ $instance->status ? $instance->corner_buffered :
                                            $instance->classification->classification }}</div>
                                        <div class="image-container dashboard" style="background-image: linear-gradient(to bottom, rgba(0,0,0,0) 17%,rgba(0,0,0,0.54) 72%,rgba(0,0,0,0.65) 83%,rgba(0,0,0,0.65) 98%), url('{{$instance->status ? url($instance->my_image_buffered):url($instance->my_image)}}')">

                                        <div class="container"> 
                                            <div class="row-c">
                                                <div class="div2">{{ $instance->status ? $instance->quantity_buffered:$instance->quantity}}</div>
                                                <div class="div1">
                                                    <div class="porcentaje">{{$instance->status ? $instance->unit_buffered: $instance->unit}}</div>
                                                    <div class="sentence">{{ $instance->status ? $instance->sentence_buffered:$instance->sentence }}</div>
                                                </div>
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
                        @endif
                    @endforeach
                </div>   
        </div>

        



</div>
</div>



@include('partials/footer')

@endsection
