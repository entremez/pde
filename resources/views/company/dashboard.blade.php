@extends('layouts.puente')
@section('title', 'PDE | Dashboard')

@section('content')

@include('partials/menu')
<div class="after-menu"></div>

<div class="col-md-10 offset-md-1 section">
    <div class="row">
        <div class="col-md-3 provider-data display-none">
            
            @include('company/sidebar')

        </div>
        <div class="col-md-9 text-center">

            <div class="row">
                <div class="col display-mobile">
                    <video controls class="w-100">
                          <source src="{{ asset('images/video_bien_publico.mp4') }}" type="video/mp4">
                        Your browser does not support the video tag.
                    </video>
                 </div>

                <div class="col-md-6 left-column dffdcjcsb">

                    <div class="margin-x margin-top-3">
                        <h5>El diseño mejora significativamente la rentabilidad de los negocios</h5>
                        <p>El viaje Puente Diseño Empresa es una herramienta que te ayudará a descubrir qué nivel de diseño tiene tu empresa, te guiará en cómo puedes integrar diseño y qué tipo de diseño es el indicado para tus desafíos.</p>
                    </div>
                    <div class="margin-bottom-3">
                        <button class="btn btn-danger" data-toggle="modal" data-target="#modalTravel">Haz click aquí para evaluar tu empresa</button>
                    </div>
                </div>
                <div class="col-md-6 display-none">
                    <video controls class="w-100">
                          <source src="{{ asset('images/video_bien_publico.mp4') }}" type="video/mp4">
                        Your browser does not support the video tag.
                    </video>

                </div>
            </div>

            <div class="horizontal-line" style="border-bottom: 1px solid lightgray"></div>
            @if($company->hasTravels())
                <div class="mt-3">
                    @include('company/last-travel')
                </div>
            @else
                @include('partials/display')
            @endif
        </div>
    </div>
</div>


@include('partials/footer')

<div class="modal fade mx-0 px-0" id="modalTravel" tabindex="-1" role="dialog" aria-labelledby="modalTravel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog modal-survey" role="document">

    <div class="modal-content">
        @include('company/travel')

    </div>

  </div>
</div>


@endsection
