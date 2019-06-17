@extends('layouts.puente')
@section('title', 'PDE | Dashboard')

@section('content')

@include('partials/menu')
<div class="after-menu"></div>

<div class="col-md-10 offset-md-1 mt-5">
    <div class="row">
        <div class="col-md-3 provider-data">
            
            @include('company/sidebar')

        </div>
        <div class="col-md-9 text-center">

            @if($surveys->count()>0)
                <div class="row">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-3">
                                <img width="100%" src="{{ asset('/images/stairs/'.$surveys[0]->level->image) }}" alt="">
                            </div>
                            <div class="col-md-6">
                                <p>Última autoevaluación: {{ $surveys[0]->getDate()}}</p>
                                <p class="text-left stairs-phrase">Actualmente {{ $surveys[0]->level->phrase }}</p>
                                <div class="row">
                                    <div class="col-md-2">
                                        <a href="{{ route('pdf', [$surveys[0]->id]) }}" class="link-default"><i class="far fa-file-pdf" style="font-size: 3rem;"></i></a>
                                    </div>
                                    <div class="col-md-10">
                                        <p class="text-right">Área: {{ $surveys[0]->area->name }}</p>
                                        <p class="text-right">Servicio: {{ $surveys[0]->service->name }}</p>   
                                    </div>  
                                </div>
                            </div>
                            <div class="col-md-3">
                                <img width="100%" src="{{ asset('/images/areas/'.$surveys[0]->area->image) }}" alt="">
                            </div>
                        </div>
                        
                    </div>
                </div>   
                @if($surveys->count() > 1)
                    <div class="row">
                    @foreach($surveys as $key => $survey)
                        @if($key != 0)
                                <div class="col-md-3">
                                    <img width="50%" src="{{ asset('/images/stairs/'.$survey->level->image) }}" alt="">
                                    <p>{{ $survey->getDate()}}</p>
                                    <a href="{{ route('pdf', [$surveys[0]->id]) }}" class="link-default"><i class="far fa-file-pdf" style="font-size: 1rem;"></i></a>
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

