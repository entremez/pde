@extends('layouts.app')

@section('content')
<div class="container espacio">
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <div class="h2 text-center">Para iniciar el viaje inicia sesión</div>
                <form class="form-horizontal" method="POST" action="{{ route('login') }}">
                    {{ csrf_field() }}
                    <input type="hidden" name="travel" value="travel">
                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                        <label for="email" class="col-md-4 control-label">Correo electrónico</label>

                        <div class="col-md-12">
                            <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>

                            @if ($errors->has('email'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                        <label for="password" class="col-md-4 control-label">Contraseña</label>

                        <div class="col-md-12">
                            <input id="password" type="password" class="form-control" name="password" required>

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
                        <div class="col-md-8 offset-md-2">
                            <button type="submit" class="btn btn-primary">
                                Login
                            </button>

                            <a class="btn btn-link" href="{{ route('password.request') }}">
                                Forgot Your Password?
                            </a>
                        </div>
                    </div>

                </form>
        </div>
        <div class="container text-center">
            <div class="row">
                <div class="col">
                    <a href="{{ route('register') }}" class="btn btn-success">Regístrate</a>
                    <a href="{{ route('travel.guest') }}" class="btn btn-info" data-toggle="tooltip" data-placement="right" title="" data-container="body" data-original-title="Puedes hacer una versión reducida del viaje. Si luego de terminarlo quieres ver más, tendrás la oportunidad de registarte y guardar tus resultados.">Viaja sin registro</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
