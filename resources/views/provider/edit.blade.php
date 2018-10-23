@extends('layouts.puente')
@section('title', 'PDE | ')

@section('content')

@include('partials/menu')


<div class="after-menu"></div>

<div class="col-md-10 offset-md-1">
    <h2 class="text-center mt-0">Editar caso</h2>
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

    <form class="contact-form" method="POST" action="{{ route('cases.update', $case->id ) }}">
        {{ csrf_field() }}
        {{ method_field('PUT') }}
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label class="bmd-label-floating">Nombre</label>
                    <input type="text" name="name" class="form-control" value="{{ old('name', $case->name) }}" required>
                    <small>Utiliza un nombre de fantasía para el caso</small>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label class="bmd-label-floating">Nombre empresa</label>
                    <input type="text" name="company_name" class="form-control" value="{{ old('company_name', $case->company_name) }}" required>
                    <small>Nombre de la empresa donde se llevó a cabo el caso</small>
                </div>
            </div>
        </div>
        <div class="form-group">
            <label for="exampleMessage" class="bmd-label-floating">Cuéntanos en una frase de que se trata el caso</label>
            <input type="text" name="description" class="form-control" rows="4" id="exampleMessage" value="{{ old('description', $case->description) }}">
        </div>
        <div class="form-group">
            <label for="exampleMessage" class="bmd-label-floating">Cuéntanos con mas detalle el caso</label>
            <textarea type="textarea" name="long_description" class="form-control" rows="4" id="exampleMessage">{{ old('long_description', $case->long_description) }}</textarea>
        </div>
        <h4>Selecciona a que servicio de los que prestas pertenece este caso de éxito</h4>
        <div class="row">
            @foreach($services as $service)
            <div class="col-md-3 col-sm-4">
                <div class="form-check">
                    <label class="form-check-label">
                        <input class="form-check-input" type="checkbox" name="service[]" value="{{ $service->id }}" @foreach($case->services()->get() as $service_case)
                            {{ $service_case->service_id == $service->id ? 'checked':''  }}
                        @endforeach
                        >{{ $service->name }}
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
                <a href="{{ route('cases.index') }}" class="btn btn-defautl btn-raised">
                    Volver
                </a>
                <button type="submit" class="btn btn-primary btn-raised">
                    Actualizar
                </button>
            </div>
        </div>
    </form>
</div>

@include('partials/footer')

@endsection
