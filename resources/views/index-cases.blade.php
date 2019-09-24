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
        <div class="col-md-3 col-sm-0">
            <div class="input-group">
                <input type="text" class="form-control search-place display-none"  placeholder="Busca un caso" >
            </div>

            <div class="display-mobile title-filters">
                <p>Filtros</p>
            </div>
            <div class="display-none">
                <p class="mb-2 mt-3">Tamaño de la empresa</p>
            </div>
            <div class="display-mobile filter-toggle">
                <p class="mb-2 mt-3">Tamaño de la empresa&nbsp;&nbsp;<i class="fas fa-angle-down"></i></p>
            </div>
            <div class="filters-target display-none">
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
            </div>

            <div class="display-none">
                <p class="mb-2 mt-3">Rubro</p>
            </div>
            <div class="display-mobile filter-toggle">
                <p class="mb-2 mt-3">Rubro&nbsp;&nbsp;<i class="fas fa-angle-down"></i></p>
            </div>
            <div class="filters-target display-none">
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
            </div>

            <div class="display-none">
                <p class="mb-2 mt-3">Tipo de negocio</p>
            </div>
            <div class="display-mobile filter-toggle">
                <p class="mb-2 mt-3">Tipo de negocio&nbsp;&nbsp;<i class="fas fa-angle-down"></i></p>
            </div>
            <div class="filters-target display-none">
                @foreach($business_types as $business_type)
                <div class="form-check">
                    <label class="form-check-label docepx">
                        <input class="form-check-input filter" type="checkbox" name="business_type" value="{{ $business_type->id }}" {{ ($key == 6 && $id == $business_type->id) ? 'checked' : ''  }}>
                        <div data-toggle="tooltip" data-placement="right" title="{{ $business_type->description }}">{{ $business_type->type }}</div>
                        <span class="form-check-sign">
                            <span class="check"></span>
                        </span>
                    </label>
                </div>
                @endforeach
            </div>

            <div class="display-none">
                <p class="mb-2 mt-3">Regiones</p>
            </div>
            <div class="display-mobile filter-toggle">
                <p class="mb-2 mt-3">Regiones&nbsp;&nbsp;<i class="fas fa-angle-down"></i></p>
            </div>
            <div class="filters-target display-none">
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
            </div>

            <div class="display-none">
                <p class="mb-2 mt-3">Categorias de diseño</p>
            </div>
            <div class="display-mobile filter-toggle">
                <p class="mb-2 mt-3">Categorias de diseño&nbsp;&nbsp;<i class="fas fa-angle-down"></i></p>
            </div>
            <div class="filters-target display-none">
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
            </div>

            @if($key == 2 OR $key == 5)
                <input type="hidden" name="{{ $key == 2 ? 'classification':'year' }}" value="{{ $id }}">
            @endif
        </div>

        <div class="col-md-9 col-sm-0 margin-top-3">
            <div class="row filtered">
                @foreach($cases as $case)
                <div class="col-md-4 col-sm-6">
                    @include('partials/instance')
                </div>
                @endforeach
            </div>
        </div>
        <form method="post" action="{{ route('cases') }}" id="form-filter">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
        </form>
    </div>

</div>


@foreach($classifications as $classification)
    
    <input type="hidden" id="classification-{{$classification->id}}" value="{{$classification->classification}}">

@endforeach

@foreach($cases as $case)
    <input type="hidden" id="image-{{$case->id}}" value="{{url($case->my_image)}}">
@endforeach



@include('partials/footer')


@endsection