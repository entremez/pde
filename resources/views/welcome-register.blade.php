@extends('layouts.puente')
@section('title', 'Puente DE')


@section('content')

@include('partials/menu-register-initial')

<div class="after-menu"></div>

<div class="col-md-6 offset-md-3 my-2 section text-center" >

              <h3 class="text-center pb-4">Registro empresas</h3>

            <div class="col-md-10 offset-md-1 my-3">
                <form class="form-horizontal" method="POST" action="{{ route('register-company') }}" id="form-register">
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

@include('partials/footer')
@endsection