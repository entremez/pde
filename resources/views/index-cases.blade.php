@extends('layouts.puente')
@section('title', 'Casos de diseño en los negocios')

@section('content')

@include('partials/menu')

<section class="banner-title">
    <div class="title">
        <h2>Casos de diseño en los negocios</h2>
    </div>
</section>

<section class="filters">
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <form>
                    <div class="input-group mb-3">
                      <div class="input-group-prepend">
                        <button class="btn btn-outline-secondary" type="button">P</button>
                      </div>
                      <input type="text" class="form-control" placeholder="" aria-label="" aria-describedby="basic-addon1">
                    </div>
                </form>

            </div>
            <div class="col-md-9">
                <div class="row">
                    @foreach( $cases as $case)
                    <div class="col-md-4 ">
                        <div class="service">
                            <div class="image-container">
                                  <img src="{{ $case->images->first()->image }}" alt="Avatar" class="image-service" style="height: 150px">
                                  <div class="middle-service">
                                    <div class="text-service">"{{ $case->description }}"</div>
                                  </div>
                            </div>
                            <div class="footer-service">
                                <p>{{ $case->name }}</p>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>

@include('partials/footer')

@endsection