@extends('layouts.puente')
@section('title', 'PDE | Configurar')

@section('content')

@include('partials/menu')

<div class="after-menu"></div>
<div class="col-md-10 offset-md-1">
    <h2 class="text-center pt-5 pb-3">Completa tu perfil</h2>
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
    <form class="contact-form" method="POST" action="{{ route('provider.config') }}" enctype="multipart/form-data" id="submit-config-provider">
        {{ csrf_field() }}

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label class="bmd-label-floating">Nombre de empresa</label>
                    <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
                </div>
            </div>
            <div class="col-md-6">
                <label class="bmd-label-floating">Rut de su empresa</label>
                <input type="text" class="form-control" name="rut" id="rut" value="{{ old('rut') }}" required>
            </div>
        </div>




        <div class="row pt-4">
            <div class="col-md-6">
                <div class="form-group">
                <label for="region">Región</label>
                    <select class="form-control" id="region" name="region" required>
                      <option value="">Seleccionar...</option>
                        @foreach($cities as $city)
                            <option value="{{ $city->id }}" >{{ $city->region }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label class="bmd-label-floating">Comuna</label>
                    <select class="form-control" id="commune" name="commune">
                      <option value="">Seleccione región...</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="row pt-4">

            <div class="col-md-6">
                <div class="form-group">
                    <label class="bmd-label-floating">Dirección</label>
                    <input type="text" name="address" class="form-control" value="{{ old('address') }}" required>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label class="bmd-label-floating">Teléfono</label>
                    <input type="text" name="phone" class="form-control" value="{{ old('phone') }}" required>
                </div>
            </div>
        </div>

        <div class="row py-4">
            <div class="col-md-6">
                <div class="form-group">
                    <label class="bmd-label-floating">Sitio Web</label>
                    <input type="text" name="web" class="form-control" value="{{ old('web') }}">
                </div>
            </div>
        </div>

<div class="mb-3 dm-uploader" id="drag-and-drop-zone">
  <div class="form-row">
    <div class="col-md-9 col-sm-12 align-grid-r">
      <div class="from-group mb-2">
        <div>Agregar su logo o una imagen que los represente&nbsp;&nbsp;&nbsp;<small>(Formatos permitidos: jpeg, png, bmp, gif o svg)</small></div>
        <div class="errorLogo"></div>
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
        <div role="button" class="btn btn-danger mr-2">
          Examinar archivos
          <input type="file" id="file-input" name="logo" />
        </div>
      </div>
    </div>
    <div class="col-md-3  d-md-block  d-sm-none align-grid image-container">
      <img src="{{ asset('/images/not-found.png') }}" alt="sin imagen" class="w-100" id="imgSalida">
    </div>
  </div>
</div>


        <div class="form-group">
            <label for="long_description" class="bmd-label-floating">Describe a tu empresa&nbsp;&nbsp;&nbsp;<small>(500 caracteres)</small></label>
            <textarea type="textarea" name="long_description" class="form-control" rows="4" id="long_description" maxlength="500">{{ old('long_description') }}</textarea>
        </div>
        <div class="servicios">            
            <label class="bmd-label-floating pt-4">Selecciona los servicios que prestas</label>
            <div class="errorTxt"></div>
            <div class="row pt-3">

                @foreach($categories as $key=>$category)
                        <div class="col-md-3 mb-providers">
                            <div class="service">
                                <h3>{{ $category->name }}</h3>
                                <ul>
                                    @foreach($services as $service)
                                        @if($service->category_id == $category->id)
                                        <div class="form-check" data-toggle="tooltip" data-placement="left" title="{{ $service->description }}">
                                            <label class="form-check-label" >
                                                <input class="form-check-input" type="checkbox" name="service[]" value="{{ $service->id }}" @if(is_array(old('service')) && in_array($service->id,old('service'))) checked @endif ><span class="docepx">{{ $service->name }}</span>
                                                <span class="form-check-sign">
                                                    <span class="check"></span>
                                                </span>
                                            </label>
                                        </div>
                                        @endif
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                @endforeach


            </div>
        </div>
        <div class="regiones">            
            <label class="bmd-label-floating pt-4">Selecciona regiones donde la empresa presta sus servicios</label>
            <div class="errorRegions"></div>
            <div class="row pt-3">

                @foreach($cities as $city)
                    @if($city->id < 17 )
                    <div class="col-md-3">
                        <div class="form-check">
                            <label class="form-check-label">
                                <input class="form-check-input" type="checkbox" name="regions[]" value="{{ $city->id }}" ><span class="docepx">{{ $city->region }}</span>
                                <span class="form-check-sign">
                                    <span class="check"></span>
                                </span>
                            </label>
                        </div>
                    </div>
                    @endif
                @endforeach

                @foreach($cities as $city)
                    @if($city->id >= 17 )
                    <div class="col-md-3">
                        <div class="form-check">
                            <label class="form-check-label">
                                <input class="form-check-input" type="checkbox" name="regions[]" value="{{ $city->id }}" ><span class="docepx">{{ $city->region }}</span>
                                <span class="form-check-sign">
                                    <span class="check"></span>
                                </span>
                            </label>
                        </div>
                    </div>
                    @endif
                @endforeach



            </div>
        </div>
        <br>

    <label class="bmd-label-floating mb-3">Caracterización de profesionales de diseño en su empresa (indicar sólo el nivel más alto por profesional)</label>

<div class="members pb-5">

    <div class="form-group row">
        <label for="team-tecnics" class="col-md-4 col-sm-6 col-form-label caracterizacion">Colaboradores con formación técnica en diseño</label>
        <div class="col-md-2 col-sm-6">
            <input type="number" name="team-tecnics" min="0" value="{{ old('team-tecnics', 0) }}" class="form-control mt-0">
        </div>
    </div>

    <div class="form-group row">
        <label for="team-professionals" class="col-md-4 col-sm-6 col-form-label caracterizacion">Colaboradores con formación profesional</label>
        <div class="col-md-2 col-sm-6">
            <input type="number" name="team-professionals" min="0" value="{{ old('team-professionals', 0) }}" class="form-control mt-0">
        </div>
    </div>

    <div class="form-group row">
        <div for="team-masters" class="col-md-4 col-sm-6 col-form-label caracterizacion">Colaboradores con grado magister en diseño</div>
        <div class="col-md-2 col-sm-6">
            <input type="number" name="team-masters" min="0" value="{{ old('team-masters', 0) }}" class="form-control mt-0">
        </div>
    </div>

    <div class="form-group row">
        <label for="team-doctors" class="col-md-4 col-sm-6 col-form-label caracterizacion">Colaboradores con formación doctorado en diseño</label>
        <div class="col-md-2 col-sm-6">
            <input type="number" name="team-doctors" min="0" value="{{ old('team-doctors', 0) }}" class="form-control mt-0">
        </div>
    </div>
</div>

@include('partials/terms')

        <div class="row">
            <div class="col-md-4 ml-auto mr-auto text-center">
                <button type="submit" class="btn btn-danger btn-raised">
                    Guardar datos
                </button>
            </div>
        </div>
    </form>
</div>

        <form method="post" action="{{ route('cities') }}" id="form-cities">
            <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
        </form>

@include('partials/footer')
@endsection