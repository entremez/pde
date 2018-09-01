@extends('layouts.puente')
@section('title', 'Evalúa tu empresa')

@section('content')

@include('partials/menu')

<section class="banner-title">
    <div class="title">
        <h2>Evalua y mejora el diseño de tu empresa</h2>
    </div>
</section>

<section class="cicle">
    <div class="container">
        <div class="row">
                <img src="images/cicle.png" alt="Ciclo" class="image-cicle">
        </div>
        <div class="row">
            <div class="cicle-container">
                <div class="cicle-text">
                    <h3>Registrate</h3>
                    <p>Registra tu empresa para poder evaluarla. En tu perfil quedarán los registros de tus evaluaciones.</p>
                </div>
                <div class="cicle-text">
                    <h3>Cuestionario</h3>
                    <p>Responde el cuestionario para evaluar tu empresa. No te tomará más de 5 minutos.</p>
                </div>
                <div class="cicle-text">
                    <h3>Diagnóstico</h3>
                    <p>Después de contestar el cuestionario, se te entregará el diagnóstico de tu empresa.</p>
                </div>
                <div class="cicle-text">
                    <h3>Proveedores</h3>
                    <p>En la sección de proveedores podrás buscar quien te puede ayudar con tu empresa según lo diagnosticado.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="columns-evaluate">
    <div class="row">
        <div class="col-md-10 offset-md-1">
            <div class="row">
                <div class="col-md-6 left-column">
                    <h2>El diseño mejora significativamente la rentabilidad de los negocios</h2>
                    <p>El viaje Puente Diseño Empresa es una herramienta que te ayudará a descubrir qué nivel de diseño tiene tu empresa, te guiará en cómo puedes integrar diseño y qué tipo de diseño es el indicado para tus desafíos.</p>
                    <div class="button-bottom">
                        <button class="btn btn-danger btn-block">Regístrate para evaluar tu empresa</button>
                    </div>
                </div>
                <div class="col-md-6">
                    <iframe width="560" height="315" src="https://www.youtube.com/embed/99JdbGWVL1M" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
                </div>
            </div>
        </div>
    </div>
</section>


@include('partials/footer')

@endsection