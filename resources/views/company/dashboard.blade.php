@extends('layouts.puente')
@section('title', 'PDE | Dashboard')

@section('content')

@include('partials/menu')
<div class="after-menu"></div>

<div class="col-md-10 offset-md-1">
    <div class="row mt-5">
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

            <a class="btn btn-danger" href="{{ route('travel') }}">Evalua tu empresa</a>

        </div>
    </div>
</div>


@include('partials/footer')

@endsection

