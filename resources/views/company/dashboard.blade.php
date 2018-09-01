
@extends('layouts.puente')
@section('title', 'PDE | Dashboard')

@section('content')

@include('partials/menu')
<section class="company-dashboard">
    <div class="container">
        <div class="row">
            <div class="col-md-8 vertical-line">
                <div class="container-progressbar">
                    <ul class="progressbar">
                              <li class="active">Registrate <br>
                              <p class="progressbar-text">Registra tu empresa para poder evaluarla. En tu perfil quedarán los registros de tus evaluaciones</p></li>
                              <li class="{{ $travels->count() > 0? 'active':''}}">Cuestionario <br>
                              <p class="progressbar-text">Responde el cuestionario para evaluar tu empresa. No te tomará más de 5 minutos.</p></li>
                              <li class="{{ $travels->count() > 0? 'active':''}}">Diagnostico <br>
                              <p class="progressbar-text">Después de contestar el cuestionario, se te entregará el diagnóstico de tu empresa.</p></li>
                              <li>Proveedores <br>
                              <p class="{{ $travels->count() > 0? 'active':''}}">En la sección de proveedores podrás buscar quien te puede ayudar con tu empresa según lo diagnosticado.</p></li>
                    </ul>
                </div>
                <div style="clear: both;"></div>
                <section class="survey">
                    <h3 class="text-center pb-3">Cuestionario</h3>
                    <form id="survey-form" method="post" action="{{ route('company.result') }}">
                        {{ csrf_field() }}
                        @include('survey')
                        <button id="send-survey" class="btn btn-danger">Obtener resultados</button>
                    </form>
                </section>
            </div>
            <div class="col-md-4">
                @if($travels->count() > 0)
                    @foreach($travels as $key => $travel)
                        <h3 class="travel-title">Diagnóstico {{ $key+1 }}</h3>
                        <p class="travel-date">({{ Carbon\Carbon::parse($travel->created_at)->format('d-m-Y ') }} )</p>
                        <p class="travel-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                        tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                        quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                        consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                        cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
                        proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                    @endforeach
                @else
                    <button class="btn btn-danger">Realiza tu primer diagnóstico</button>
                @endif
            </div>
        </div>
    </div>
</section>

@include('partials/footer')



