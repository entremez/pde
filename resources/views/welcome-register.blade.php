@extends('layouts.puente')
@section('title', 'Puente DE')


@section('content')

@include('partials/menu-register-initial')

<div class="after-menu"></div>

<div class="col-md-10 offset-md-1 my-2 section text-center" >

        <div class="col-md-12">
          <div class="row login">
            <div class="col-md-6">
              <h3 class="text-center pb-4">Iniciar sesión</h3>

<div class="col-md-10 offset-md-1 my-3">
    <form class="form-horizontal" method="POST" action="{{ route('login') }}" id="submit-login">
        {{ csrf_field() }}

        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
            <label for="email" class="col-md-12 control-label">Correo electrónico</label>

            <div class="col-md-12">
                <input id="email-login" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>

                @if ($errors->has('email'))
                    <span id="name-error">
                        {{ $errors->first('email') }}
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

        <div class="form-group l-margin" style="margin-top: 62px;">
            <div class="col-md-12 text-center bottom pb-4">
                <button class="btn btn-danger btn-register d-block w-100">
                    Entrar
                </button>

                <div class="btn btn-link" href="{{ route('password.update') }}">
                    ¿Olvidaste tu contraseña?
                </div>
            </div>
        </div>

    </form>
</div>

            </div>
            <div class="col-md-6" style="border-left: solid 1px #F0F0F0">
              <h3 class="text-center pb-4">Registrarse</h3>

<div class="col-md-10 offset-md-1 my-3">
    <form class="form-horizontal" method="POST" action="{{ route('register') }}" id="form-register">
        {{ csrf_field() }}

        <div class="form-group{{ $errors->has('email-register') ? ' has-error' : '' }}">
            <label for="email-register" class="col-md-12 control-label">Correo electrónico</label>

            <div class="col-md-12">
                <input id="email-register" type="email" class="form-control" name="email-register" value="{{ old('email-register') }}" required>

                @if ($errors->has('email-register'))
                    <span class="help-block">
                        {{ $errors->first('email-register') }}
                    </span>
                @endif
            </div>
        </div>

        <div class="form-group{{ $errors->has('password-register') ? ' has-error' : '' }}">
            <label for="password-register" class="col-md-12 control-label">Contraseña</label>

            <div class="col-md-12">
                <input id="password-register" type="password" class="form-control" name="password-register" required>

                @if ($errors->has('password-register'))
                    <span class="help-block">
                        {{ $errors->first('password-register') }}
                    </span>
                @endif
            </div>
        </div>

        <div class="form-group">
            <label for="password-confirm-register" class="col-md-12 control-label">Confirmar contraseña</label>

            <div class="col-md-12">
                <input id="password-confirm-register" type="password" class="form-control" name="password-confirm-register" required>
            </div>
        </div>

        <div class="form-group">
            <div class="col-md-12">
                <div class="checkbox">
                    <label>
                        <input type="checkbox" name="provider" checked style="display: none"> 
                    </label>
                </div>
            </div>
        </div>        

        <div class="form-group pt-4">
            <div class="col-md-12 text-center">
                <button class="btn btn-danger btn-register d-block w-100" id="submit-register" >
                    Completar registro
                </button>
            </div>
        </div>
    </form>
</div>

            </div>
          </div>
        </div>

</div>

@include('partials/footer')
@endsection