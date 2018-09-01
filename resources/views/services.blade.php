@extends('layouts.blank')
@section('css')
    <style type="text/css">
        .main-raised {
            margin: 0!important;
            border-radius: 0!important;
            box-shadow: none!important;
        }
        .espacio {
                margin-top: 80px!important;
        }
    </style>
@endsection

@section('content')
<div class="container">
<br><br><br>
<div class="row">
    <div class="col-md-4">
        <div class="row">
            <div class="col-md-3 pt-3"><h3>TAG:</h3></div>
            <div class="col-md-6"><h1 class="mb-4">{{ $service->name }}</h1></div>
        </div>
    </div>
    <div class="col-md-4"></div>
    <div class="col-md-4"></div>

</div>
<div class="row">
    @foreach($instances as $instance)
        @foreach($instance->instances as $instance)
            <div class="col-md-4 parent" style="background-image:url({{ url($instance->featured_image) }})">
                <div class="card child" style="background: rgba(255, 255, 255, 0.47);" >
                    <!-- <img class="card-img-top" alt="Card image cap"> -->
                    <div class="card-body" style="background-color: #ffffff4d!important">
                        <h5 class="card-title">{{ ucfirst($instance->name) }}</h5>
                        <p class="card-text">{{ $instance->description }}</p>
                        <a href="{{ route('case', $instance->id) }}" class="btn btn-primary text-center">Ver caso</a>
                    </div>

                </div>
                <br>
            </div>
        @endforeach
    @endforeach
</div>
</div>


@endsection