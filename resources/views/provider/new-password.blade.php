@extends('layouts.puente')
@section('title', 'PDE | Cambio de contraseña')

@section('content')

@include('partials/menu')


<div class="after-menu"></div>
    <div class="col-md-10 offset-md-1">
        <div class="row">
            <div class="col">
                <form class="form-horizontal" method="POST" action="{{ route('password.store') }}" id="form-new-pass">
                    {{ csrf_field() }}

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                        <label for="password" class="col-md-4 control-label">Nueva contraseña</label>

                        <div class="col-md-6">
                            <input id="password" type="password" class="form-control" name="password" required>
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                        <label for="password-confirm" class="col-md-4 control-label">Confirmar nueva contraseña</label>
                        <div class="col-md-6">
                            <input id="password_confirm" type="password" class="form-control" name="password_confirmation" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-4">
                            <button type="submit" class="btn btn-primary">
                                Cambiar contraseña
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>



@include('partials/footer')

@endsection
