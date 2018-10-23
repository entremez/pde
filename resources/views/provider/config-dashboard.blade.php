@extends('layouts.puente')
@section('title', 'PDE | Configurar')

@section('content')

@include('partials/menu')

<div class="after-menu"></div>
<div class="col-md-10 offset-md-1">
    <h2>Completa tu perfil</h2>
            @if ($errors->any())
            <div class="alert alert-danger">
                <button type="button" class="close" aria-label="Close" data-dismiss="alert">
                  <span aria-hidden="true">&times;</span>
                </button>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
    <form class="contact-form" method="POST" action="{{ route('provider.config') }}" enctype="multipart/form-data">
        {{ csrf_field() }}

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label class="bmd-label-floating">Nombre</label>
                    <input type="text" name="name" class="form-control" value="{{ old('name', $data->name) }}" required>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label class="bmd-label-floating">Dirección</label>
                    <input type="text" name="address" class="form-control" value="{{ old('address', $data->address) }}" required>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label class="bmd-label-floating">Página Web</label>
                    <input type="text" name="web" class="form-control" value="{{ old('web', $data->web) }}">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label class="bmd-label-floating">Teléfono</label>
                    <input type="text" name="phone" class="form-control" value="{{ old('phone', $data->phone) }}" required>
                </div>
            </div>
        </div>

<div class="mb-3 dm-uploader" id="drag-and-drop-zone">
  <div class="form-row">
    <div class="col-md-9 col-sm-12 align-grid-r">
      <div class="from-group mb-2">
        <label>Agregar su logo o una imagen que los represente</label>
        <input type="text" class="form-control" aria-describedby="fileHelp" placeholder="Selecciona una imagen..." readonly="readonly" id="image-data" />

        <div class="progress mb-2 d-none">
          <div class="progress-bar progress-bar-striped progress-bar-animated bg-primary" 
            role="progressbar"
            style="width: 0%;" 
            aria-valuenow="0" aria-valuemin="0" aria-valuemax="0">
            0%
          </div>
        </div>

      </div>
      <div class="form-group">
        <div role="button" class="btn btn-primary mr-2">
          Examinar archivos
          <input type="file" id="file-input" name="logo" />
        </div>
      </div>
    </div>
    <div class="col-md-3  d-md-block  d-sm-none align-grid">
      <img src="https://danielmg.org/assets/image/noimage.jpg?v=v10" alt="..." class="img-thumbnail w-100" id="imgSalida">
    </div>
  </div>
</div>

        <div class="form-group">
            <label for="exampleMessage" class="bmd-label-floating">Cuéntanos, en pocas palabras, algo de tu empresa</label>
            <textarea type="textarea" name="description" class="form-control" rows="2" id="exampleMessage">{{ old('description', $data->description) }}</textarea>
        </div>

        <div class="form-group">
            <label for="exampleMessage" class="bmd-label-floating">Cuéntanos de tus servicios</label>
            <textarea type="textarea" name="long_description" class="form-control" rows="4" id="exampleMessage">{{ old('long_description', $data->long_description) }}</textarea>
        </div>

            <h4>Selecciona los servicios que prestas</h4>
        <div class="row">

            @foreach($services as $service)
            <div class="col-md-3 col-sm-4">
                <div class="form-check">
                    <label class="form-check-label">
                        <input class="form-check-input" type="checkbox" name="service[]" value="{{ $service->id }}" @if(is_array(old('service')) && in_array($service->id,old('service'))) checked @endif >{{ $service->name }}
                        <span class="form-check-sign">
                            <span class="check"></span>
                        </span>
                    </label>
                </div>
            </div>
            @endforeach
        </div>
        <br>
        <div class="row">
            <div class="col-md-4 ml-auto mr-auto text-center">
                <button type="submit" class="btn btn-primary btn-raised">
                    Enviar
                </button>
            </div>
        </div>
    </form>
</div>



@include('partials/footer')
@endsection