@extends('imaxd.layouts.puente')
@section('title', 'IMAxD')
@section('title-imaxd-home', 'active-menu')
@section('content')

@include('imaxd.partials.menu')


<div class="main">
    <div class="main__wrapper">
        <div>
            <h1>Bienvenido a IMAxD</h1>
            <p>Puente Diseño Empresa y la Fundación para la Innovación Agraria del Ministerio de Agricultura lo invitan a postular al fondo IMAxD. </p>    
        </div>
    </div>
</div>

<div class="what">
    <div class="what__title">
        <p>¿En qué consiste el fondo IMAxD?</p>
    </div>
    <div class="what__content">
        <div class="what__content-item">
            <img src="{{asset('imaxd_assets/images/message_round.png')}}" alt="text icon">
            <div class="card">
                <p class="title">Cuál es el objetivo del IMAxD</p>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mattis et sed nam sem tellus erat.</p>
            </div>
        </div>
        <div class="what__content-item">
            <img src="{{asset('imaxd_assets/images/message_round.png')}}" alt="text icon">
            <div class="card">
                <p class="title">Cuál es el objetivo del IMAxD</p>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mattis et sed nam sem tellus erat.</p>
            </div>
        </div>
        <div class="what__content-item">
            <img src="{{asset('imaxd_assets/images/message_round.png')}}" alt="text icon">
            <div class="card">
                <p class="title">Cuál es el objetivo del IMAxD</p>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mattis et sed nam sem tellus erat.</p>
            </div>
        </div>
        <div class="what__content-item">
            <img src="{{asset('imaxd_assets/images/message_round.png')}}" alt="text icon">
            <div class="card">
                <p class="title">Cuál es el objetivo del IMAxD</p>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mattis et sed nam sem tellus erat.</p>
            </div>
        </div>
    </div>
</div>

<div class="stages">
    <div class="stages__wrapper">
        <p class="section_title">Etapas del Proceso</p>
        <ul class="stages__content">
            <li>
                <div class="title">
                    <span>Inscripción</span>
                    <span class="dashed"></span>
                </div>
                <div class="description">Turn your idea from concept to MVP</div>
            </li>
            <li>
                <div class="title">
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



@include('imaxd.partials.footer')


@endsection


