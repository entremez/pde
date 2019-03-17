
<div class="col-md-10 offset-md-1 my-3" id="register">
    <form class="form-horizontal" method="POST" action="{{ route('register') }}" id="form-register">
        {{ csrf_field() }}

        <div class="form-group{{ $errors->has('email-register') ? ' has-error' : '' }}">
            <label for="email-register" class="col-md-12 control-label">Correo electrónico</label>

            <div class="col-md-12">
                <input id="email-register" type="email" class="form-control email-register" name="email-register" value="{{ old('email-register') }}" required>

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

        <div class="form-group pt-4">
            <div class="col-md-12 text-center">
                <button class="btn btn-danger btn-register d-block w-100" id="submit-register" >
                    Completar registro para evaluar tu empresa
                </button>
            </div>
        </div>
    </form>
</div>

