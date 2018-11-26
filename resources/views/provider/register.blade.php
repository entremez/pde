@extends('layouts.puente')
@section('title', 'PDE | Regístrate como proveedor de servicios de diseño')

@section('content')

@include('partials/menu')

@section('content')

<div class="after-menu"></div>

<div class="col-md-10 offset-md-1">

{{ $errors }}
    <div class="row">
        <div class="col-md-6 vertical-line">
            <h2 class="text-center mb-4 mt-5">Iniciar sesión</h2>
            
            <form class="form-horizontal" method="POST" action="{{ route('login') }}">
                {{ csrf_field() }}

                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                    <label for="email" class="col-md-12 control-label">Correo electrónico</label>

                    <div class="col-md-12">
                        <input id="email-login" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>

                        @if ($errors->has('email'))
                            <span class="help-block">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                    <label for="password" class="col-md-12 control-label">Contraseña</label>

                    <div class="col-md-12">
                        <input id="password-login" type="password" class="form-control" name="password" required>

                        @if ($errors->has('password'))
                            <span class="help-block">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-md-12">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Recuérdame
                            </label>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-md-12 text-center bottom pb-4">
                        <div class="btn btn-danger btn-register d-block" id="submit-login-providers">
                            Entrar
                        </div>

                        <div class="btn btn-link" href="{{ route('password.request') }}">
                            ¿Olvidaste tu contraseña?
                        </div>
                    </div>
                </div>

            </form>

        </div>
        <div class="col-md-6">

            <h2 class="text-center mb-4 mt-5">Registrarse</h2>
            <form method="POST" action="{{ route('provider-register') }}" class="form-horizontal" id="submit-register-provider">
                {{ csrf_field() }}

                <div class="row">
                    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }} col-md-6">
                        <label for="name" class="control-label">Nombre de la empresa</label>
                            <input type="text" class="form-control" name="name" value="{{ old('name') }}" id="name" required>

                            @if ($errors->has('name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                            @endif
                    </div>

                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}  col-md-6">
                        <label for="email" class="control-label">Correo electrónico</label>
                        <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>
                        @if ($errors->has('email'))
                            <span class="help-block">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>
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

        <div class="form-group" style="    margin-top: 40px;">
            <div class="col-md-12 text-center bottom pb-4 px-0">
                <button class="btn btn-danger btn-register d-block w-100" >
                    Registrarse
                </button>

            </div>
        </div>

            </form>
        </div>
    </div>
</div>
@include('partials/footer')

@endsection

