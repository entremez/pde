@extends('layouts.puente')
@section('title', 'PDE | Dashboard')

@section('content')

@include('partials/menu')
<div class="after-menu"></div>

<div class="col-md-10 offset-md-1 mt-4">
    <div class="row">
        <div class="col-md-3 provider-data display-none">
            
            @include('company/sidebar')

        </div>
        <div class="col-md-9 text-center">
            @csrf
            <input type="hidden" id="url" value="{{ route('popup') }}">
            @if($surveys->count()>0)
                <div class="row">
                    <div class="col-md-12 borders-top-bottom pt-4">
                        <div class="row">
                            <div class="col-md-3">
                                <img width="100%" src="{{ asset('/images/stairs/'.$surveys[0]->level->image) }}" alt="">
                            </div>
                            <div class="col-md-9">
                                <div class="text-right">
                                    <p>Última autoevaluación: {{ $surveys[0]->getDate()}}</p>
                                </div>
                                <p class="text-left stairs-phrase">Actualmente {{ $surveys[0]->level->phrase }}</p>

                                <div class="text-right" style="font-size: 3rem;">
                                    <a href="{{ route('pdf', [$surveys[0]->id]) }}" class="link-default"><i class="far fa-file-pdf" style="font-size: 3rem;"></i></a>

                                </div>
                            </div>
                        </div>
                        <div class="text-center show-survey">
                                <p>Desplegar evaluación completa<br>
                                <i class="fas fa-angle-down" style="font-size: 2.5rem;color: gray;"></i></p>
                        </div>
                    </div>
                </div> 
                <div id="show-survey">
                    @include('company/last-travel')
                </div>  
                
                @if($surveys->count() > 1)
                    <div class="row mt-4">
                    @foreach($surveys as $key => $survey)
                        @if($key != 0)
                                <div class="col-md-3 feature">
                                    <div class="link-default mr-2 travel-popup" data-id="{{ $survey->id }}">
                                        <img width="50%" src="{{ asset('/images/stairs/'.$survey->level->image) }}" alt="">
                                        <p>{{ $survey->getDate()}}</p>
                                        <a href="{{ route('pdf', [$survey->id]) }}" class="link-default"><i class="far fa-file-pdf" style="font-size: 1rem;"></i></a>
                                    </div>
                                </div>                            
                        @endif
                    @endforeach
                    </div>
                @endif             
            @else
                <p>Aún no has completado tu primera autoevaluación.</p>
            @endif
        </div>
    </div>
</div>


@include('partials/footer')


<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="modalT">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="row mx-0">
            <div class="response-header" style="background-image: url('{{ asset('/images/FONDO-diagonal-titulo.png') }}'); ">
                <div class="display-header-title">Resultado de Evaluación</div>
            </div>
        </div>
        <div class="row mx-0">
            <div class="col-md-7 pl-5">
                <p class="text-left mt-3" style="font-size: 1.3rem" id="date"></p>
                <p class="text-left stairs-phrase">Actualmente el diseño <span id="phrase"></span></p>
                <p class="same-level">El <span id="percentage"></span>% de las empresas inscritas en el Puente están en tu mismo nivel.</p>
            </div>
            <div class="col-md-5 px-5 mt-4">
                <div class="text-right">
                    <img style="width: 100%" alt="" id="image-stair">
                </div>
            </div>
        </div>
        <div class="row mt-5 mx-0">
            <div class="response-header" style="background-image: url('{{ asset('/images/FONDO-diagonal-titulo.png') }}'); ">
                <div class="display-header-title">Recomendaciones</div>
            </div>
            <div class="col-md-8 pl-5 mt-5">
                <p class="text-left stairs-phrase"><span class="font-weight-bold">Si quieres mejorar tu negocio</span> mediante el uso de diseño en el ámbito de <span id="area"></span> te recomendamos utilizar <span class="font-weight-bold"><span id="service"></span>.</span>
                </p>
            </div>
            <div class="col-md-4 px-5 mt-5">
                <div class="text-right">
                    <img style="width: 100%" alt="" id="image-area">
                </div>      
            </div>
            
        </div>
        <div class="row mt-5 mx-0">
            <div class="response-header" style="background-image: url('{{ asset('/images/FONDO-diagonal-titulo.png') }}'); ">
                <div class="display-header-title">Proveedores</div>
            </div>
            <div class="col-md-12 px-5 mt-5">
                <h4>Los proveedores presentes en esta plataforma que ofrecen este tipo de servicio son:</h4>
            </div>

            
            <div class="container" id="providers"></div>

            <div class="row w-100 mt-3">
                <div class="col-md-12 view-more-recommendations">
                    <a href="" target="_blank" class="btn btn-danger btn-view-more-service" id="link-recommendation">Ver más proveedores <i class="fas fa-chevron-right"></i></a>
                </div>
            </div>
        </div>
        <div class="row mt-5 mx-0">
            <div class="response-header" style="background-image: url('{{ asset('/images/FONDO-diagonal-titulo.png') }}'); ">
                <div class="display-header-title">Viaje del uso de diseño</div>
            </div>
            <div class="col-md-12 px-5 mt-5">
                <h4 class="font-weight-bold">Si no sabes qué implica la contratación de diseño te recomendamos mirar lo siguiente.</h4>
                <h4 class="mt-3">En términos generales, un servicio de diseño contempla las siguientes macro-etapas:</h4>
                <span class="span-stages">(Si quieres indagar en cada una puedes desplegar cada pestaña)</span>
            </div>
        </div>
        <div class="row mt-5 mx-0">
            @foreach($stages as $key1 => $stage)
            <div class="stage w-100 stage-response">
                <span class="stage-name">{{ $key1 +1}}. {{ $stage->name }}</span>
                <div><i class="fas fa-angle-down" style="
                                                            font-size: 2.5rem;
                                                            color: gray;"></i></div>
            </div>
                    <div class="titles-response">
                    @php $count = 1; @endphp
                        @foreach($stage->titles as $title)
                            <div class="position-relative">    
                                <div class="sub-stage" style="border-top-color: {{ $title->border  }} ;background-color: {{ $title->background }};
                                background-image: url('{{ asset('images/TRIANGULO-SUPERIOR-DERECHA.png')}}') ,url('{{ asset('images/TRIANGULO-INFERIOR-DERECHA.png')}}')">
                                    <div class="sub-stage-name"><span>{{ $key1 +1}}.{{ $count }} {{ $title->name }}</span></div>
                                    @php $count++; @endphp
                                    <div class="sub-stage-image"><img src="{{ $title->image() }}" alt="" class="w-100"></div>
                                </div>
                                <div class="arrow-down"><i class="fas fa-angle-down"></i></div>
                                <div class="arrow-up"><i class="fas fa-angle-up"></i></div>
                            </div>
                            <div class="stage-content">
                                <div class="row">
                                    @foreach($title->bodies as $key => $body)
                                    <div class="col-md-4 border-{{ $key }}">
                                        <div class="w-title" style="background-color: {{ $body->sentence->background }}"><span>{{ $body->sentence->sentence }}</span></div>
                                    </div>
                                    @endforeach
                                    @foreach($title->bodies as $key => $body)
                                    <div class="col-md-4  border-{{ $key }}">
                                        <div class="w-body h-100" style="background-color: {{ $body->background }}">{{ $body->body }}</div>
                                    </div>
                                    @endforeach      
                                </div>
                             </div>
                        @endforeach
                    </div>
            @endforeach
        </div>
        <div class="row mx-0 mb-5">
            <div class="response-header" style="background-image: url('{{ asset('/images/FONDO-diagonal-titulo.png') }}'); ">
                <div class="display-header-title">Formas de financiamiento</div>
            </div>
            <div class="col-md-12 px-5 mt-5">
                <h4>Cifras extranjeras muestran que <span class="font-weight-bold"> el retorno del diseño es aproximadamente 20 veces la inversión.</span><br> Invertir en diseño te conviene.</h4>

                <h4>Si no cuentas con los recursos existen múltiples instrumentos públicos y privados que podrían ayudarte a financiar diseño. Entre ellos están:</h4>

                <div class="row">
                @foreach($fundings as $funding)
                    <div class="col-md-3 col-sm-6">
                        <div class="service">
                            <a href="{{ $funding->web }}" target="_blank">
                                <img src="{{ asset('/images/fundings/'.$funding->image) }}" alt="" class="w-100">
                            </a>
                        </div>
                    </div>
                @endforeach
                </div>

                <div class="text-center">
                    <a href="#!" class="btn btn-danger btn-view-more-service mt-5">Ver más fuentes de financiamiento <i class="fas fa-chevron-right"></i></a>
                </div>
            </div>
        </div>
    </div>
  </div>
</div>

@endsection

