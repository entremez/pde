@extends('layouts.puente')
@section('title', 'PDE | Dashboard')

@section('content')

@include('partials/menu')
<div class="after-menu"></div>

<div class="col-md-10 offset-md-1">
    <h2 class="text-center mt-0">Agregar un caso de éxito</h2>
            @if ($errors->any())
            <div class="alert alert-danger rounded">
                <button type="button" class="close" aria-label="Close" data-dismiss="alert">
                  <span aria-hidden="true">&times;</span>
                </button>
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li >{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

    @if($user->instances()->count() < config('constants.max_cases'))
    <form class="contact-form" method="POST" action="{{ route('cases.store') }}" enctype="multipart/form-data">
        {{ csrf_field() }}

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label class="bmd-label-floating">Nombre</label>

                    <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
                    <small>Utiliza un nombre de fantasía para el caso</small>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label class="bmd-label-floating">Nombre empresa</label>
                    <input type="text" name="company_name" class="form-control" value="{{ old('company_name') }}" required>
                    <small>Nombre de la empresa donde se llevó a cabo el caso</small>
                </div>
            </div>
        </div>
            <div>Seleccione la actividad de la empresa</div>
        <div class="row py-2">
            @foreach($sectors as $sector)
                <div class="col-md-4">
                    <div data-id="{{ $sector->id }}" id="sector">{{ $sector->name }}</div>
                </div>
            @endforeach
            @foreach($sectors as $sector)
                <div class="col-md-12" id="classifications">
                    @foreach($sector->classifications()->get() as $classification)
                        <div class="d-inline" id="classification" data-id="{{ $sector->id }}">{{ $classification->classification }}</div>
                    @endforeach
                </div>
            @endforeach
        </div>
        <div class="form-group">
            <label for="exampleMessage" class="bmd-label-floating">Cuéntanos en una frase de que se trata el caso</label>
            <input type="text" name="description" class="form-control" rows="4" id="exampleMessage" value="{{ old('description') }}">
        </div>
        <div class="form-group">
            <label for="exampleMessage" class="bmd-label-floating">Cuéntanos con mas detalle el caso</label>
            <textarea type="textarea" name="long_description" class="form-control" rows="4" id="exampleMessage">{{ old('long_description') }}</textarea>
        </div>
<!--
        <div class="row pt-5">
            <div class="col-md-4 ml-auto mr-auto text-center">
                <label class="fileContainer">
                    <button type="button" class="btn btn-success"><i class="material-icons">add_a_photo</i> Selecciona imágenes que representen el caso <input type="file" name="images[]" required multiple></button>
                    <ul class="pl-0" id="file">Máximo 4</ul>
                </label>
            </div>
        </div>-->

        <div class="row mb-4 mx-auto">
            <div class="col-md-4 text-center mx-auto my-4">

                    <div class="image-container" id="imgSalida" style="display: none"></div>
                <label class="fileContainer">
                    <button type="button" class="btn btn-success btn-file">Adjunta tu logo o una imagen que los represente (4 max)<input type="file" id="file" name="images[]" required multiple></button>
                </label>
            </div>
        </div>

            <h4>Selecciona a que servicio de los que prestas pertenece este caso de éxito</h4>
        <div class="row">

            @foreach($services as $service)
            <div class="col-md-3 col-sm-4">
                <div class="form-check">
                    <label class="form-check-label">
                        <input class="form-check-input" type="checkbox" name="service[]" value="{{ $service->id }}" @if(is_array(old('service')) && in_array($service->id,old('service'))) checked @endif >{{ $service->name }}
                        <span class="form-check-sign">
                            <span class="check"></span>
                        </span>
                    </label>
                </div>
            </div>
            @endforeach
        </div>
        <br>
        <div class="row">
            <div class="col-md-4 ml-auto mr-auto text-center">
                <button type="submit" class="btn btn-primary btn-raised">
                    Enviar
                </button>
            </div>
        </div>
    </form>
    @else
    <h3>Has superado el máximo de casos para agregar, si deseas ingresar uno nuevo, elimina uno de los existentes.</h3>
    @endif
</div>

@include('partials/footer')

@endsection
