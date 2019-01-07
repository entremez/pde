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

<div class="col-md-10 offset-md-1 mt-5">
    <div class="section-title">
        <p class="mt-0"><span class="first-color">Casos de diseño</span> <span class="secondary-color">en distintas áreas de negocios</span></p>
    </div>

<div class="row">
    <div class="col-3">
<div class="input-group">
                        <input type="text" class="form-control search-place"  placeholder="Busca un caso" >
                    </div>

                    <p class="mb-2 mt-3">Tamaño de la empresa</p>
                    @foreach($employees_range as $range)
                    <div class="form-check">
                        <label class="form-check-label docepx">
                            <input class="form-check-input filter" type="checkbox" name="employee" value="{{ $range->id }}" {{ ($key == 3 && $id == $range->id) ? 'checked' : ''  }}>
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
                        <label class="form-check-label docepx">
                            <input class="form-check-input filter" type="checkbox" name="sector" value="{{ $sector->id }}" {{ ($key == 1 && $id == $sector->id) ? 'checked' : ''  }}>
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
                        <label class="form-check-label docepx">
                            <input class="form-check-input filter" type="checkbox" name="city" value="{{ $city->id }}" {{ ($key == 4 && $id == $city->id) ? 'checked' : ''  }}>
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
                        <label class="form-check-label docepx">
                            <input class="form-check-input filter" type="checkbox" name="category" value="{{ $category->id }}"><div class="category">{{ $category->name }}&nbsp;&nbsp;<i class="fas fa-angle-down"></i></div>
                            <span class="form-check-sign">
                                <span class="check"></span>
                            </span>
                        </label>
                            <div class="service-toggle">
                                @foreach($category->services()->get() as $service)
                                    <div class="form-check">    
                                        <label class="form-check-label docepx">
                                            <input class="form-check-input filter" type="checkbox" name="service" value="{{ $service->id }}" {{ ($key == 0 && $id == $service->id) ? 'checked' : ''  }}>{{ $service->name }}<span class="form-check-sign">
                                                <span class="check"></span>
                                            </span>
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                    </div>
                    @endforeach

                    @if($key == 2 OR $key == 5)
                        <input type="hidden" name="{{ $key == 2 ? 'classification':'year' }}" value="{{ $id }}">
                    @endif

    </div>
        <form method="post" action="{{ route('cases') }}" id="form-filter">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
        </form>
    <div class="col-9">
        <div class="row filtered">
            @foreach($cases as $case)
            <div class="col-md-4 col-sm-6">
                <div class="service">
                    <a href="{{ route('case', $case->id) }}">
                            <div class="corner">{{ $case->classification->classification }}</div>
                        <div class="image-container" style="background-image: linear-gradient(to bottom, rgba(0,0,0,0) 17%,rgba(0,0,0,0.54) 72%,rgba(0,0,0,0.65) 83%,rgba(0,0,0,0.65) 98%), url('{{url($case->image)}}')">

                        <div class="container"> 
                                <div class="row-c">
                                <div class="div2">{{ $case->quantity}}</div>
                                <div class="div1"><div class="porcentaje">{{  $case->unit }}</div><br>{{ $case->sentence }}</div>
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


@foreach($classifications as $classification)
    
    <input type="hidden" id="classification-{{$classification->id}}" value="{{$classification->classification}}">

@endforeach

@foreach($cases as $case)
    <input type="hidden" id="image-{{$case->id}}" value="{{url($case->image)}}">
@endforeach



@include('partials/footer')


@endsection