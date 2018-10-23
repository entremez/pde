@extends('layouts.puente')
@section('title', 'PDE | Dashboard')

@section('content')

@include('partials/menu')
<div class="after-menu"></div>

<div class="col-md-10 offset-md-1">
    <div class="row mt-4">
        <div class="col-md-3">
            <img src="{{ $data->url }}" class="rounded mx-auto d-block img-fluid provider-logo"  alt="provider logo">
        </div>
        <div class="col-md-3 text-center">
            <h1>{{ $data->name }}</h1>
        </div>
        <div class="col-md-3  text-center">
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
        <div class="col-md-3 text-left">
            <div class="row">
                <div class="col-md-10"><p>{{ $user->email }}</p></div>
            </div>
            <div class="row">
                <div class="col-md-10"><p>{{ $phone }}</p></div>
            </div>
            <div class="row">
                <div class="col-md-10"><p>{{ Rut::parse($data->rut."-".$data->dv_rut)->format()}}</p></div>
            </div>
            <div class="row">
                <div class="col-md-10"><p>{{ $data->address }}</p></div>
            </div>
        </div>
    </div>

    <hr class="horizontal-line">
        <div class="row text-center">
            <div class="col-md-6">
                @if($data->cases()->count() < config('constants.min_cases'))
                <p>Se debe agregar al menos {{ config('constants.min_cases') }} caso de éxito.</p>
                <a href="{{ route('cases.create') }}" class="btn btn-danger">Agregar caso</a>
                @else
                <a href="{{ route('cases.index') }}" class="btn btn-danger">Ver casos</a>
                <p>Muy bien, tienes {{ $data->cases()->count() }} caso(s) agregado(s).</p>
                @endif
            </div>
            <div class="col-md-6">
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

@include('partials/footer')

@endsection
