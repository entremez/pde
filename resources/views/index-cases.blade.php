@extends('layouts.puente')
@section('title', 'Casos de diseño en los negocios')
@section('title-cases', 'active-menu')
@section('content')

@include('partials/menu')

<div class="after-menu"></div>
<div class="contenedor mb-5">
<img src="{{url('/banners/2.jpg')}}" class="w-100">
  <div class="centrado">Casos de diseño en los negocios</div>
</div> 

<div class="col-md-10 offset-md-1">

    <div class="row">
            <div class="col-md-3">
            Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
                proident, sunt in culpa qui officia deserunt mollit anim id est laborum.    
            </div>
            <div class="col-md-9">
                <div class="row">
                    @foreach($cases as $key =>$case)
                    @php
                        $class = "col-md-4 col-sm-6";
                        $izquierda = "div2";
                        $derecha = "div1";
                        $porcentaje = "porcentaje";
                    @endphp
                    <div class="{{ $class }}">
                        <div class="service">
                            <a href="{{ route('case', $case->id) }}">
                                    <div class="corner">{{ $case->classification->classification }}</div>
                                <div class="image-container" style="background-image: linear-gradient(to bottom, rgba(0,0,0,0) 17%,rgba(0,0,0,0.54) 72%,rgba(0,0,0,0.65) 83%,rgba(0,0,0,0.65) 98%), url('{{url($case->image)}}')">

                                <div class="container"> 
                                        <div class="row-c">
                                        <div class="{{$izquierda}}">{{ $case->percentage}}</div>
                                        <div class="{{$derecha}}"><div class="{{$porcentaje}}">%</div><br>{{ $case->result }}</div>
                                        </div>
                                </div>
                                        
                                </div>
                            </a>
                        </div>
                    </div>

                    @endforeach
                </div>
            </div>
    </div>

</div>


@include('partials/footer')

@endsection