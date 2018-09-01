{{-- @extends('layouts.app')
@section('timeline', 'active')
@section('css')
@endsection
 --}}

@extends('layouts.puente')
@section('title','Timeline')
@section('content')

@if($number_of_surveys > 0)
<h2>Tu progreso</h2>
    <div class="row">
        <div class="col-md-12">
            <ul class="timeline">
                @foreach($surveys as $survey)
                <li class="timeline-item">
                    <div class="timeline-badge"><i class="material-icons">location_on</i></div>
                    <div class="timeline-panel">
                        <div class="timeline-heading">
                            <h4 class="timeline-title">Total {{ $survey->total }}</h4>
                            <p><small class="text-muted"><i class="material-icons" style="font-size: 11px">access_time</i> {{ Carbon\Carbon::parse($survey->created_at)->format( 'd/m/Y') }}</small></p>
                        </div>
                        <div class="timeline-body">
                            <p></p>
                        </div>
                    </div>
                </li>
                @endforeach
                <li class="timeline-item">
                    <div class="timeline-badge"><i class="material-icons">flight_takeoff</i></div>
                    <div class="timeline-panel" style="visibility: hidden;">
                        <div class="timeline-heading">
                            <h4 class="timeline-title">Mussum ipsum cacilds 4</h4>
                            <p><small class="text-muted"> 11 hours ago via Twitter</small></p>
                        </div>
                        <div class="timeline-body">
                            <p>Mussum ipsum cacilds, vidis litro abertis. Consetis adipiscings elitis. Pra lá , depois divoltis porris, paradis. Paisis, filhis, espiritis santis. Mé faiz elementum girarzis, nisi eros vermeio, in elementis mé pra quem é amistosis quis leo. Manduma pindureta quium dia nois paga. Sapien in monti palavris qui num significa nadis i pareci latim. Interessantiss quisso pudia ce receita de bolis, mais bolis eu num gostis.</p>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </div>
@else
    <h2 class="mt-0">Inicia el viaje</h2>
    <span class="h7">No tenemos nada que mostrarte aun, inicia el viaje y sigue tus resultados.</span><br>
    <div class="pt-3">
        <button class="btn btn-primary btn-round">
            <i class="fa fa-plane"></i>
        </button>
    </div>
@endif
@endsection
