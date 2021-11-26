@extends('imaxd.layouts.puente')
@section('title', 'IMAxD - Resultados')
@section('title-imaxd-home', 'active-menu')
@section('content')

@include('imaxd.partials.menu')

<div class="result">
    <h3>Resultados autoevaluación</h3>
    <div class="stages">
        <div class="stages__wrapper">
            <ul class="stages__content">
                <li>
                    <div class="title ready">
                        <span>Datos empresa</span>
                        <span class="dashed"></span>
                    </div>
                    <div class="description">Ingresar información de la empresa</div>
                </li>
                <li>
                    <div class="title ready">
                        <span>Antecedentes de Diseño</span>
                        <span class="dashed"></span>
                    </div>
                    <div class="description">Ingresar información relacionada con su vínculo con el Diseño</div>
                </li>
                <li>
                    <div class="title ready">
                        <span>Resultado</span>
                        <span class="dashed"></span>
                    </div>
                    <div class="description">Enviar para recibir el resultado</div>
                </li>         
            </ul>
        </div>
    </div>
    @if($is_elegible)
        @include('imaxd.result-check')
    @else
        @include('imaxd.result-not')
    @endif
    {{ $results }}
</div>

@include('imaxd.partials.footer')


@endsection
