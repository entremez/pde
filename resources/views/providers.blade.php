
@extends('layouts.puente')
@section('title', 'Proveedores de diseño')
@section('title-providers', 'active-menu')

@section('content')

@include('partials/menu')

<div class="after-menu"></div>
<div class="contenedor mb-5">
<img src="{{url('/banners/3.jpg')}}" class="w-100">
  <div class="centrado">Proveedores de servicios de diseño</div>
</div> 

<div class="col-md-10 offset-md-1 mt-5  section">
    <h4 class="mb-5">¿Qué servicio de diseño necesitas?</h4>
    <div class="row">    
        @foreach($categories as $key=>$category)
            @if($key!=7 && $key!=8)
                <div class="col-md-3 mb-providers">
                    <div class="service">
                        <h3>{{ $category->name }}</h3>
                        <ul>
                            @foreach($services as $service)
                                @if($service->category_id == $category->id)
                                    <li id="service" data-id="{{ $service->id }}"><a href="{{ route('providers-list', $service->id) }}" class="link service-filter">{{ $service->name }}</a></li>
                                @endif
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endif
        @endforeach
        <div class="col-md-3">
            <div class="service" id="formacion">
                    <h3 style="cursor: pointer;">{{ $categories[7]->name }}&nbsp;<i class="fas fa-angle-down"></i></h3>
                <div class="formacion categorias">
                    <ul>
                        @foreach($services as $key => $service)
                            @if($service->category_id == $categories[7]->id)
                                <li id="service" data-id="{{ $service->id }}"><a href="{{ route('providers-list', $service->id) }}" class="link service-filter">{{ $service->name }}</a></li>
                            @endif
                        @endforeach  
                    </ul>
                </div>
            </div>
            <br>
            <div class="service">
                <div class="service" id="proveedores">
                <h3 style="cursor: pointer;">{{ $categories[8]->name }}&nbsp;<i class="fas fa-angle-down"></i></h3>
                <div class="proveedores categorias">
                <ul>
                    @foreach($services as $key => $service)
                        @if($service->category_id == $categories[8]->id)
                            <li id="service" data-id="{{ $service->id }}"><a href="{{ route('providers-list', $service->id) }}" class="link service-filter">{{ $service->name }}</a></li>
                        @endif
                    @endforeach  
                </ul>
            </div>
            </div>  
            </div>          
        </div>       
    </div>
    <hr class="horizontal-line">



<form method="post" action="{{ route('providers-list-filtered', ':SERVICE_ID') }}" id="form-filter">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
</form>
</div>


<div class="col-md-10 offset-md-1 section">
    <div class="results" id="results">
    <div class="row">
        @foreach($providers as $provider)
        <div class="col-md-3 col-sm-6">
            <div class="service">
                <a href="{{ route('provider', $provider->id) }}">
                    <div class="image-container" style="background-image: url('{{url($provider->imagen_logo)}}')" title="{{$provider->name}}">         
                    </div>
                </a>
            </div>
        </div>
        @endforeach
    </div>
    </div>
</div>




@include('partials/footer')

@endsection

