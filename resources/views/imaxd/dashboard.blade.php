@extends('imaxd.layouts.puente')
@section('title', 'IMAxD')
@section('title-imaxd-home', 'active-menu')
@section('content')

@include('imaxd.partials.menu')

<div class="dashboard">
    <h3>Escritorio {{ $user->full_name }} IMAxD</h3>
    <div class="information">
        <a href="">Información {{ $user->full_name }}</a>
        <a href="">Actualizar información</a>
    </div>

    <div class="stages">
        <div class="stages__wrapper">
            <p class="section_title">Etapas del Proceso</p>
            <ul class="stages__content">
                <li>
                    <div class="title ready">
                        <span>Inscripción</span>
                        <span class="dashed"></span>
                    </div>
                    <div class="description">Turn your idea from concept to MVP</div>
                </li>
                <li>
                    <div class="title @if($user->hasEvaluationRunning()) warning @endif">
                        <span>Autoevaluación</span>
                        <span class="dashed"></span>
                    </div>
                    <div class="description">Sketch out the product to align the user needs</div>
                </li>
                <li>
                    <div class="title">
                        <span>Resultados</span>
                        <span class="dashed"></span>
                    </div>
                    <div class="description">Convert the designs into a live application</div>
                </li>
                <li>
                    <div class="title">
                        <span>Postulación</span>
                        <span class="dashed"></span>
                    </div>
                    <div class="description">Launching the application to the market</div>
                </li>           
            </ul>
        </div>
    </div>
    <div class="evaluate">
        <a href="{{ route('imaxd-evaluate') }}">
            @if($user->hasEvaluationRunning())
                Continúa tu autoevaluación
            @else
                Autoevalúate
            @endif
        </a>
    </div>
    @if($has_evaluation_done)
        @foreach($older_evaluations as $evaluation)
            {{ $evaluation }}

        @endforeach
    @endif
</div>




@include('imaxd.partials.footer')


@endsection
