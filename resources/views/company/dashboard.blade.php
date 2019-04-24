@extends('layouts.puente')
@section('title', 'PDE | Dashboard')

@section('content')

@include('partials/menu')
<div class="after-menu"></div>

<div class="col-md-10 offset-md-1 section">
    <div class="row">
        <div class="col-md-3 provider-data">
            
                <p>{{ $data->name }}</p>
                <hr>
                <p>{{ Rut::parse($data->rut."-".$data->dv_rut)->format()}}</p>
                <hr>
                <p>{{ $data->address }}</p>
                <hr>
                <p>{{ $data->phone }}</p>
                <hr>
                <br>
                <a class="btn btn-danger" href="">Editar</a>
        </div>
        <div class="col-md-9 text-center">

            <a class="btn btn-danger" href="{{ route('travel') }}" style="display: none">Evalua tu empresa</a>

            @include('partials/display')
        </div>
    </div>
</div>


@include('partials/footer')

@endsection

