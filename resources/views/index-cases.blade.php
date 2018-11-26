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
 
                    <div class="input-group">
                        <input type="text" class="form-control search-place"  placeholder="Busca un caso" >
                    </div>

                    <p class="mb-2 mt-3">Tamaño de la empresa</p>
                    @foreach($employees_range as $range)
                    <div class="form-check">
                        <label class="form-check-label">
                            <input class="form-check-input" type="checkbox" name="employee">
                            {{ $range->range }} empleados
                            <span class="form-check-sign">
                                <span class="check"></span>
                            </span>
                        </label>
                    </div>
                    @endforeach

                    <p class="mb-2 mt-3">Rubro</p>
                    @foreach($sectors as $sector)
                    <div class="form-check">
                        <label class="form-check-label">
                            <input class="form-check-input" type="checkbox" name="sector">
                            <div data-toggle="tooltip" data-placement="right" title="{{ $sector->tooltip }}">{{ $sector->name }}</div>
                            <span class="form-check-sign">
                                <span class="check"></span>
                            </span>
                        </label>
                    </div>
                    @endforeach

                    <p class="mb-2 mt-3">Regiones</p>
                    @foreach($cities as $city)
                    <div class="form-check">
                        <label class="form-check-label">
                            <input class="form-check-input" type="checkbox" name="sector">
                            {{ $city->region }}
                            <span class="form-check-sign">
                                <span class="check"></span>
                            </span>
                        </label>
                    </div>
                    @endforeach

                    <p class="mb-2 mt-3">Categorías de diseño</p>
                    @foreach($categories as $category)
                    <div class="form-check">
                        <label class="form-check-label">
                            <input class="form-check-input" type="checkbox" name="sector">
                            {{ $category->name }}
                            <span class="form-check-sign">
                                <span class="check"></span>
                            </span>
                        </label>
                    </div>
                    @endforeach
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
                                        <div class="{{$izquierda}}">{{ $case->quantity}}</div>
                                        <div class="{{$derecha}}"><div class="{{$porcentaje}}">{{ $case->unit}}</div><br>{{ $case->sentence }}</div>
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