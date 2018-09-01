@extends('layouts.app')
@section('dashboard', 'active')

@section('content')
<ol class="breadcrumb">
    <li class="breadcrumb-item active" aria-current="page">Inicio</li>
</ol>
<div class="container">
        <br>
        @if(Session::has( 'success' ))
            <div class="alert alert-success rounded">
                <button type="button" class="close" aria-label="Close" data-dismiss="alert">
                  <span aria-hidden="true">&times;</span>
                </button>
                <ul class="mb-0">
                    {{ Session::get( 'success' ) }}
                </ul>
            </div>
        @endif
        <div class="row">
            <div class="col-md-4 ">
                <img src="{{ $data->url }}" class="rounded mx-auto d-block img-fluid" style="width: 250px;" alt="...">
            </div>
            <div class="col-md-4 text-center">
                <h1>{{ $data->name }}</h1>
            </div>
            <div class="col-md-4 text-left">
                <div class="row">
                    <div class="col-md-2"><i class="material-icons">mail_outline</i></div>
                    <div class="col-md-10"><p>{{ $user->email }}</p></div>
                </div>
                <div class="row">
                    <div class="col-md-2"><i class="material-icons">phone</i></div>
                    <div class="col-md-10"><p>{{ $phone }}</p></div>
                </div>
                <div class="row">
                    <div class="col-md-2"><i class="material-icons">fingerprint</i></div>
                    <div class="col-md-10"><p>{{ Rut::parse($data->rut."-".$data->dv_rut)->format()}}</p></div>
                </div>
                <div class="row">
                    <div class="col-md-2"><i class="material-icons">location_on</i></div>
                    <div class="col-md-10"><p>{{ $data->address }}</p></div>
                </div>
                <div class="row">
                    <div class="col">
                        @foreach($services as $service)
                        <span class="badge badge-success">
                            {{ $service->service()->get()->first()->name }}
                        </span>
                        @endforeach
                    </div>
                </div>
            </div>
    </div>
    <br>

    <div class="progress progress-line-danger">
        <div class="progress-bar progress-bar-success" style="width: 33%">
<!--             <span class="sr-only">33% Complete (success)</span> -->
        </div>
        <div class="progress-bar progress-bar-{{ $data->cases()->count() >= config('constants.min_cases') ? 'success':'danger' }}" style="width: 33%">
<!--             <span class="sr-only">33% Complete (warning)</span> -->
        </div>
        <div class="progress-bar progress-bar-{{ $data->status == '1' ? 'warning':'danger' }}" style="width: 34%">
<!--             <span class="sr-only">33% Complete (danger)</span> -->
        </div>
    </div>

    <div class="container">
        <div class="row text-center">
            <div class="col-md-4">
                Completar Perfil
            </div>
            <div class="col-md-4">
                Agregar casos de éxito
            </div>
            <div class="col-md-4">
                @if($data->status == 1)
                    <p>Solicitud en revisión</p>
                @else
                    <p>Solicitar alta</p>
                @endif
            </div>
        </div>
        <div class="row text-center">
            <div class="col-md-4">
                <i class="material-icons">check</i>
            </div>
            <div class="col-md-4">
                <i class="material-icons">{{ $data->cases()->count() >= config('constants.min_cases') ? 'check':'close' }}</i>
            </div>
            <div class="col-md-4">
                <i class="material-icons">hourglass_empty</i>
            </div>
        </div>
        <div class="row text-center">
            <div class="col-md-4">
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
            </div>
            <div class="col-md-4">
                @if($data->cases()->count() < config('constants.min_cases'))
                <p>Se deben agregar al menos {{ config('constants.min_cases') }} caso de éxito.</p>
                @else
                <p>Muy bien, tienes {{ $data->cases()->count() }} caso de éxito.</p>
                @endif
            </div>
            <div class="col-md-4">
                @if($data->cases()->count() < config('constants.min_cases'))
                <p>Una vez completados los pasos anteriores solicita tu alta en el sitió en el link que aparecerá acá.</p>
                @else
                    @if($data->status == 1)
                    <p>La solicitud fue enviada a los administradores. Dentro de las próximas horas recibirás la confirmación o detalles de tu cuenta.</p>
                    @else
                    <form form class="contact-form" method="POST" action="{{ route('provider.request' ) }}">
                    {{ csrf_field() }}
                    {{ method_field('PUT') }}
                        <button class="btn btn-success">Solicitar alta</button>
                    </form>
                    <p>Presiona el boton y los administradores revisarán tu perfil.</p>
                    @endif
                @endif
            </div>
        </div>
    </div>
</div>



@endsection
