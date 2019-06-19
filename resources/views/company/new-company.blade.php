
@extends('layouts.puente')
@section('title', 'PDE | Nueva contraseña')


@section('content')

@include('partials/menu')


<div class="after-menu"></div>
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2 mt-5">
                    <form class="form-horizontal" method="POST" action="{{ route('new-company-new-pass') }}" id="submit-new-company">
                        {{ csrf_field() }}
						
						<input type="hidden" name="id" value="{{ $user->id }}">

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Nueva contraseña</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                            <label for="password-confirm" class="col-md-4 control-label">Confirmar contraseña</label>
                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>

                                @if ($errors->has('password_confirmation'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Establecer contraseña
                                </button>
                            </div>
                        </div>
                    </form>
        </div>
    </div>
</div>
@include('partials/footer')
@endsection
