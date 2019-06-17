@extends('layouts.puente')
@section('title', 'PDE | Dashboard')

@section('content')

@include('partials/menu')
<div class="after-menu"></div>

<div class="col-md-10 offset-md-1 section">
    <div class="row">
        <div class="col-md-3 provider-data">
            
            @include('company/sidebar')

        </div>
        <div class="col-md-9 text-center">
            <button class="btn btn-danger" data-toggle="modal" data-target="#modalTravel">Evalua tu empresa</button>
            @if($company->hasTravels())
                @include('company/last-travel')
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
