
@extends('layouts.puente')
@section('title', 'Proveedores de diseño')
@section('title-providers', 'active-menu')

@section('content')

@include('partials/menu')


<section class="banner-title">
    <div class="title">
        <h2>Proveedores de servicios de diseño</h2>
    </div>
</section>

<section class="filters">
    <div class="container">
        <div class="row">
            @foreach($categories as $category)
                <div class="col-md-3">
                    <div class="service">
                        <h3>{{ $category->name }}</h3>
                        <ul>
                            @foreach($services as $service)
                                @if($service->category_id == $category->id)
                                    <li class="{{ $service->id == $selected->id?'selected':'' }}"><a href="{{ route('providers-list-filtered', $service->id) }}">{{ $service->name }}</a></li>
                                @endif
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

<section class="results" id="results">
    <div class="container">
    <h2>{{ $selected->name }}</h2>
        <div class="row">
            @foreach($providers as $provider)
                <div class="col-md-3">
                    <img src="{{ $provider->provider()->first()->getUrlAttribute() }}" alt="{{ $provider->id }}">
                </div>
            @endforeach
        </div>
    </div>
</section>



@include('partials/footer')

@endsection

