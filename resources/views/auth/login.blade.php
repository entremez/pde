
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

        <div class="form-group" style="    margin-top: 87px;">
            <div class="col-md-12 text-center bottom pb-4">
                <button class="btn btn-danger btn-register d-block w-100">
                    Entrar
                </button>

                <a class="btn btn-link link-default" href="{{ route('password.update') }}">
                    ¿Olvidaste tu contraseña?
                </a>
            </div>
        </div>

    </form>
</div>



