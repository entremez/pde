
@extends('layouts.puente')
@section('title', 'Recursos')
@section('title-resources', 'active-menu')

@section('content')

@include('partials/menu')

<div class="after-menu"></div>
<div class="contenedor mb-5">
<img src="{{url('/banners/4.jpg')}}" class="w-100">
  <div class="centrado">Recursos</div>
</div> 

<div class="col-md-10 offset-md-1 mt-5">
    <div class="section-title">
        <p class="mt-0"><span class="first-color">Documentos</span> <span class="secondary-color">de interes</span></p>
    </div>
    <div class="row">
        <div class="col-md-3 col-sm-0">
            <div class="input-group">
                <input type="text" class="form-control search-place display-none"  placeholder="Busca un recurso" >
            </div>

            <div class="display-none">
                <p class="mb-2 mt-3">Orden de documentos</p>
            </div>
            <div class="display-mobile filter-toggle">
                <p class="mb-2 mt-3">Orden de documentos&nbsp;&nbsp;<i class="fas fa-angle-down"></i></p>
            </div>
            <div class="filters-target display-none">
                
                <div class="form-check">
                    <label class="form-check-label docepx">
                        <input class="form-check-input filter" type="radio" name="employee" value="1">
                        Por fecha
                        <span class="form-check-sign">
                            <span class="check"></span>
                        </span>
                    </label>
                </div>
                <div class="form-check">
                    <label class="form-check-label docepx">
                        <input class="form-check-input filter" type="radio" name="employee" value="1">
                        Por título
                        <span class="form-check-sign">
                            <span class="check"></span>
                        </span>
                    </label>
                </div>

            </div>
        </div>
        <div class="col-md-9 col-sm-0 margin-top-3">
            <div class="row">
                @foreach($links as $link)
                <div class="col-md-4 col-sm-6 mb-4">
                    <a href="{{ $link->link }}" target="_blank"><div class="image-container image-column" style="background-image: url('{{ $link->linkImage() }}');"></div></a>
                    <h6 class="provider-title">{{ $link->title }}</h6>
                    <h6 class="provider-services resources-full">{{ $link->description }}</h6>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

@include('partials/footer')

@endsection

