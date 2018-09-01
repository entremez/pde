@extends('layouts.app')
@section('cases', 'active')
@section('css')

<link rel="stylesheet" type="text/css" href="{{ asset('css/blank.css') }}">

@endsection

@section('content')
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ route('provider.dashboard') }}">Inicio</a></li>
    <li class="breadcrumb-item"><a href="{{ route('cases.index') }}">Administrar casos</a></li>
    <li class="breadcrumb-item active" aria-current="page">Imágenes caso {{ $case->name }}</li>
</ol>
    <h2 class="text-center mt-0">Imágenes del caso {{ $case->name }}</h2>
            @if ($errors->any())
            <div class="alert alert-danger rounded">
                <button type="button" class="close" aria-label="Close" data-dismiss="alert">
                  <span aria-hidden="true">&times;</span>
                </button>
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li >{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

        <div class="row">
            @foreach($case->images()->get() as $image)
            <div class="col-md-3">
                <div class="card">
                    <img class="card-img-top" src="{{ $image->url }}">
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                @if( !$image->featured)
                                <form method="post" action="{{ route('images.featured',$image->instance_id ) }}" style="height:32px">
                                    <input type="hidden" name="image_id" value="{{ $image->id }}">
                                    {{ csrf_field() }}
                                    <button type="sumbit" class="btn btn-link btn-sm mx-auto px-0 mt-2 my-auto">
                                        <i class="material-icons" style="font-size: 24px">favorite</i>
                                    </button>
                                </form>
                                @else
                                    <i class="material-icons" style="color: red">favorite</i>
                                @endif
                            </div>
                            <div class="col float-right">
                                <form method="post" action="{{ route('images.destroy',$case->id ) }}">
                                    {{ csrf_field() }}
                                    {{method_field('DELETE')}}
                                    <input type="hidden" name="image_id" value="{{ $image->id }}">
                                    <button type="submit" class="close pt-2" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @if( $case->images()->count() < config('constants.case_images') )
        <form form class="contact-form" method="POST" action="{{ route('images.update', $case->id ) }}" enctype="multipart/form-data" multiple>
            {{ csrf_field() }}
            {{ method_field('PUT') }}
            <div class="row pt-5 ">
                <div class="col-md-6 ml-auto mr-auto text-center">
                    <label class="fileContainer">
                        <button type="button" class="btn btn-success"><i class="material-icons">add_a_photo</i> Agrega imágenes al caso <input type="file" name="images[]" required multiple></button>
                        <ul class="pl-0" id="file">Máximo {{ config('constants.case_images')-$case->images()->count() }}</ul>
                    </label>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4 ml-auto mr-auto text-center">
                    <a href="{{ route('cases.index') }}" class="btn btn-defautl btn-raised">
                        Volver
                    </a>
                    <button type="submit" class="btn btn-primary btn-raised">
                        Actualizar
                    </button>
                </div>
            </div>
        </form>
        @else
        <h3>Para subir nuevas imágenes debes eliminar alguna de las existentes.</h3>
        @endif
@endsection
