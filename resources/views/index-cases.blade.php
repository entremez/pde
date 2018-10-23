@extends('layouts.puente')
@section('title', 'Casos de diseño en los negocios')

@section('content')

@include('partials/menu')

<div class="after-menu"></div>
<section class="banner-title mb-5">
    <div class="title">

    </div>
</section>

<div class="col-md-10 offset-md-1">

    <div class="row">
            <div class="col-md-3">
            Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
                proident, sunt in culpa qui officia deserunt mollit anim id est laborum.    
            </div>
            <div class="col-md-9">
                <div class="row">
                    @foreach($cases as $key =>$case)
                    @php
                        $class = "col-md-4 col-sm-6";
                        $textInstance = "text-instance-small";
                        $percentageInstance = "percentage-instance-small";
                        $descriptionIntance = "description-instance-small";
                        $small = "small";
                    @endphp
                    <div class="{{ $class }}">
                        <div class="service">
                            <a href="{{ route('case', $case->id) }}">
                                    <div class="corner">{{ $case->classification }}</div>
                                <div class="image-container op08" style="background-image: url(https://picsum.photos/800/600?image={{ $case->id }})">
                                    <div class=" {{ $small }}">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="{{ $textInstance }}">{{ $case->percentage}}</div>
                                            </div>
                                            <div class="col-sm-8 box-instance">
                                            <div class="row"> 
                                                <div class="{{ $percentageInstance }}">%</div>
                                                <div class="{{ $descriptionIntance }}">{{ $case->result }}</div>
                                            </div>
                                            </div>
                                        </div>
                                        
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
    </div>

</div>


@include('partials/footer')

@endsection