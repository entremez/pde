@extends('layouts.puente')
@section('title', 'PDE | Dashboard')

@section('content')

@include('partials/menu')
<div class="after-menu"></div>

<div class="col-md-10 offset-md-1 section">
    <div class="row">
        <div class="col-md-3 provider-data">
            

        </div>
        <div class="col-md-9 text-center">

            <button class="btn btn-danger" data-toggle="modal" data-target="#modalTravel">Evalua tu empresa</button>

            @include('partials/display')
        </div>
    </div>
</div>


@include('partials/footer')

<div class="modal fade mx-0 px-0" id="modalTravel" tabindex="-1" role="dialog" aria-labelledby="modalTravel" aria-hidden="true">
  <div class="modal-dialog modal-survey" role="document">
  <form>
    <div class="modal-content">
        @include('company/travel')

    </div>
  </form>
  </div>
</div>


@endsection
