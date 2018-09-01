@extends('layouts.app')
@section('cases.create', 'active')
@section('css')

<link rel="stylesheet" type="text/css" href="{{ asset('css/blank.css') }}">

@endsection

@section('content')
    <h2 class="text-center mt-0">Modificar datos de usuario {{ $user->mail }}</h2>
            @if ($errors->any())
            <div class="alert alert-danger">
                <button type="button" class="close" aria-label="Close" data-dismiss="alert">
                  <span aria-hidden="true">&times;</span>
                </button>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
    <form class="contact-form" method="POST" action="{{ route('provider.update') }}" enctype="multipart/form-data">
        {{ csrf_field() }}

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label class="bmd-label-floating">Nombre</label>

                    <input type="text" name="name" class="form-control" value="{{ old('name', $user->name()->name) }}" required>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label class="bmd-label-floating">Rut</label>
                    <input type="text" name="rut" class="form-control" value="{{ old('company_name', Rut::parse($user->name()->rut.'-'.$user->name()->dv_rut)->format()) }}" required>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label class="bmd-label-floating">Teléfono</label>

                    <input type="text" name="phone" class="form-control" value="{{ old('phone', $user->name()->phone) }}" required>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label class="bmd-label-floating">Web</label>
                    <input type="text" name="web" class="form-control" value="{{ old('web',$user->name()->web)}}" required>
                </div>
            </div>
        </div>
        <div class="form-group">
            <label for="exampleMessage" class="bmd-label-floating">Dirección</label>
            <input type="text" name="address" class="form-control" value="{{ old('address', $user->name()->address) }}">
        </div>
        <div class="form-group">
            <label for="exampleMessage" class="bmd-label-floating">Cuéntanos en una frase algo de tu empresa</label>
            <input type="text" name="description" class="form-control" rows="4" id="exampleMessage" value="{{ old('description', $user->name()->description) }}">
        </div>
        <div class="form-group">
            <label for="exampleMessage" class="bmd-label-floating">Cuéntanos con mas detalle lo que haces</label>
            <textarea type="textarea" name="long_description" class="form-control" rows="4" id="exampleMessage">{{ old('long_description', $user->name()->long_description) }}</textarea>
        </div>

        <div class="row pt-5 text-center">

            <div class="col-md-6 ml-auto mr-auto mx-auto">
            <output id="list">
                <img src="{{ $user->name()->url }}" alt="{{ $user->name()->name }}" class="rounded img-fluid" style="width: 300px" >
            </output>
            <label class="fileContainer mx-auto">
                <button type="button" class="btn btn-success"><i class="material-icons">add_a_photo</i> Cambia tu logo o imagen representativa <input type="file" name="files[]" id="files"  ></button>
                <ul class="pl-0" id="file"></ul>
            </label>
            </div>
        </div>
        <ul>

        </ul>

            <h4>Agrega o elimina servicios</h4>
        <div class="row">

            @foreach($services as $service)
            <div class="col-md-3 col-sm-4">
                <div class="form-check">
                    <label class="form-check-label">
                        <input class="form-check-input" type="checkbox" name="service[]" value="{{ $service->id }}"  {{ is_null($user->name()->services()->get()->where('service_id','=',$service->id)->first()) ? '' :'checked' }} >{{ $service->name }}
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
                <a href="{{ route('provider.dashboard') }}" class="btn btn-default btn-raised">
                    Cancelar
                </a>
                <button type="submit" class="btn btn-primary btn-raised">
                    Actualizar
                </button>
            </div>
        </div>
    </form>

@endsection
