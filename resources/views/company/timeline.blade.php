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
                                <div class="col-md-3">
                                    <a href="#" class="link-default mr-2 travel-popup" data-id="{{ $survey->id }}">
                                        <img width="50%" src="{{ asset('/images/stairs/'.$survey->level->image) }}" alt="">
                                        <p>{{ $survey->getDate()}}</p>
                                        <a href="{{ route('pdf', [$survey->id]) }}" class="link-default"><i class="far fa-file-pdf" style="font-size: 1rem;"></i></a>
                                    </a>
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



@endsection

