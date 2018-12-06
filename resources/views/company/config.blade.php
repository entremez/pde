
@extends('layouts.puente')
@section('title', 'PDE | Completar perfil')

@section('content')

@include('partials/menu')

<div class="after-menu"></div>

<div class="col-md-10 offset-md-1">
    <h3 class="text-center py-3">Completar registro</h3>
    <p class="py-3">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
    tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
    quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
    consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
    cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
    proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
    <form class="form-horizontal config" method="POST" action="{{ route('company.config') }}" id="form-config-company">
        {{ csrf_field() }}

        <div class="row">
            <div class="col">
                <label>Nombre o razón social de su empresa</label>
                <input type="text" class="form-control" name="name" id="name" required>
            </div>
            <div class="col">
                <label>Rut de su empresa</label>
                <input type="text" class="form-control" name="rut" id="rut" required>
            </div>
        </div>

        @include('partials/regions')

        <div class="row pt-4">
            <div class="col">
                <label>Dirección</label>
                <input type="text" class="form-control" name="address" id="address" required>
            </div>
            <div class="col">
                <label>Telefono de contacto</label>
                <div class="error"></div>
                <input type="text" class="form-control" name="phone" id="phone" required>
            </div>
        </div>

        <div class="row pt-4">
            <div class="col">
                <label>Rubro principal</label>
                <div class="classification"></div>
                <select class="form-control required" name="classification">
                    <option name="classification" value="">Seleccione...</option>
                    @foreach($classifications as $classification)
                        <option name="classification" value="{{ $classification->id }}">{{ $classification->classification }}</option>
                    @endforeach
                </select>
            </div>
        </div>


        <div class="row pt-4">
            <div class="col">
                <label>Cantidad de trabajadores </label>
                <div class="employees"></div>
                    @foreach($employees as $employee)
                    <div class="form-check">
                      <input class="form-check-input required" type="radio" name="employees" value="{{ $employee->id }}">
                      <label class="form-check-label docepx" for="employees">
                        {{ $employee->range }}
                      </label>
                    </div>
                    @endforeach
            </div>
            <div class="col">
                <label>Rango de facturación </label>
                <div class="gain"></div>
                    @foreach($gains as $gain)
                    <div class="form-check">
                      <input class="form-check-input required" type="radio" name="gain" value="{{ $gain->id }}">
                      <label class="form-check-label docepx" for="gain">
                        {{ $gain->range }} UF
                      </label>
                    </div>
                    @endforeach
            </div>
        </div>

            <hr class="horizontal-line">
        <div class="py-5 text-center">
            <button class="btn btn-danger">Enviar registro</button>
        </div>
    </form>
</div>

@include('partials/footer')

@endsection

