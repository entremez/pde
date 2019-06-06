
@extends('layouts.puente')
@section('title', 'PDE | Reset')


@section('content')

@include('partials/menu')


<div class="after-menu"></div>




<div class="col-md-10 offset-md-1 mt-5 section">
    <div class="row">

    <form method="POST" action="{{ route('password.email') }}">
        {{ csrf_field() }}

        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
            <label for="email" class="control-label">Correo electrónico registrado</label>


                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required >

        </div>

        <div class="form-group">

                <button type="submit" class="btn btn-primary">
                    Enviar enlace para establecer contraseña
                </button>
        </div>
    </form>

    </div>
</div>

@include('partials/footer')
@endsection
