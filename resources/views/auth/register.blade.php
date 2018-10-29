
<div class="col-md-10 offset-md-1 my-3">
    <form class="form-horizontal" method="POST" action="{{ route('register') }}">
        {{ csrf_field() }}

        <div class="form-group{{ $errors->has('email-register   ') ? ' has-error' : '' }}">
            <label for="email" class="col-md-12 control-label">Correo electrónico</label>

            <div class="col-md-12">
                <input id="email-register" type="email" class="form-control" name="email-register" value="{{ old('email-register') }}" required>

                @if ($errors->has('email-register'))
                    <span class="help-block">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
            <label for="password" class="col-md-12 control-label">Contraseña</label>

            <div class="col-md-12">
                <input id="password-register" type="password" class="form-control" name="password-register" required>

                @if ($errors->has('password'))
                    <span class="help-block">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <div class="form-group">
            <label for="password-confirm" class="col-md-12 control-label">Confirmar contraseña</label>

            <div class="col-md-12">
                <input id="password-confirm" type="password" class="form-control" name="password-register_confirmation" required>
            </div>
        </div>

        <div class="form-group pt-4">
            <div class="col-md-12 text-center">
                <div class="btn btn-danger btn-register d-block" id="submit-register">
                    Completar registro
                </div>

                <a class="btn btn-link" href="{{ route('provider-register') }}">
                    Si eres proveedor de diseño has click aquí
                </a>
            </div>
        </div>
    </form>
</div>

