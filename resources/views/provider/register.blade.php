@extends('layouts.app')

@section('content')
<div class="container">
    <div class="col-md-6 offset-md-3">
        <br><br>
        <h2>Registro proveedores</h2>
        <form method="POST" action="{{ url('providers/register') }}">
            {{ csrf_field() }}

            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                <label for="name" class="control-label">Razón Social</label>
                    <input type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>

                    @if ($errors->has('name'))
                        <span class="help-block">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                    @endif
            </div>

            <div class="form-group{{ $errors->has('rut') ? ' has-error' : '' }}">
                <label for="rut" class="control-label">Rut</label>
                <input id="rut" type="text" class="form-control" name="rut" value="{{ old('rut') }}" required>
                @if ($errors->has('rut'))
                    <span class="help-block">
                        <strong>{{ $errors->first('rut') }}</strong>
                    </span>
                @endif
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

            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                <label for="password" class="control-label">Contraseña</label>
                <input id="password" type="password" class="form-control" name="password" required>
                @if ($errors->has('password'))
                    <span class="help-block">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                @endif
            </div>

            <div class="form-group">
                <label for="password-confirm" class="control-label">Repetir contraseña</label>
                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
            </div>

            <div class="form-group">
                    <button type="submit" class="btn btn-primary">
                        Registrarse
                    </button>
            </div>
        </form>
    </div>
</div>
@endsection
