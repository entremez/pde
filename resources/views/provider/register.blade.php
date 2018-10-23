@extends('layouts.puente')
@section('title', 'PDE | Regístrate como proveedor de servicios de diseño')

@section('content')

@include('partials/menu')

@section('content')

<div class="after-menu"></div>
<div>
    <h2 class="text-center mb-5 mt-3">Registro proveedores de servicios de diseño</h2>
    <div class="col-md-6 offset-md-3">
        <form method="POST" action="{{ url('providers/register') }}" class="form-horizontal" id="submit-register-provider">
            {{ csrf_field() }}

            <div class="row">
                <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }} col-md-6">
                    <label for="name" class="control-label">Razón Social</label>
                        <input type="text" class="form-control" name="name" value="{{ old('name') }}" id="name" required>

                        @if ($errors->has('name'))
                            <span class="help-block">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                        @endif
                </div>
                <div class="form-group{{ $errors->has('rut') ? ' has-error' : '' }} col-md-6">
                    <label for="rut" class="control-label">Rut</label>
                    <input id="rut" type="text" class="form-control" name="rut" value="{{ old('rut') }}" required id="rut">
                    @if ($errors->has('rut'))
                        <span class="help-block">
                            <strong>{{ $errors->first('rut') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
            <div class="form-group{{ $errors->has('address') ? ' has-error' : '' }}">
                <label for="address" class="control-label">Dirección</label>
                <input type="text" class="form-control" name="address" value="{{ old('address') }}" required>
                @if ($errors->has('address'))
                    <span class="help-block">
                        <strong>{{ $errors->first('address') }}</strong>
                    </span>
                @endif
            </div>

            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                <label for="email" class="control-label">Correo electrónico</label>
                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>
                @if ($errors->has('email'))
                    <span class="help-block">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif
            </div>

            <div class="row">

                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }} col-md-6">
                    <label for="password" class="control-label">Contraseña</label>
                    <input id="password" type="password" class="form-control" name="password" required>
                    @if ($errors->has('password'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-group  col-md-6">
                    <label for="password-confirm" class="control-label">Repetir contraseña</label>
                    <input id="password-confirm" type="password" class="form-control" name="password-confirm">
                </div>
            </div>

            <div class="form-group text-center mt-5">
                <button type="submit" class="btn btn-primary">
                    Registrarse
                </button>
            </div>
        </form>
    </div>
</div>
@include('partials/footer')

@endsection

