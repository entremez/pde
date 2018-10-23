@extends('layouts.puente')
@section('title', 'PDE | Dashboard')

@section('content')

@include('partials/menu')
<div class="after-menu"></div>

<div class="col-md-10 offset-md-1">
    <h2 class="text-center mt-0">Agregar un caso de éxito</h2>
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

    @if($user->instances()->count() < config('constants.max_cases'))
    <form class="contact-form" method="POST" action="{{ route('cases.store') }}" enctype="multipart/form-data">
        {{ csrf_field() }}

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label class="bmd-label-floating">Nombre&nbsp;&nbsp;<small>Utiliza un nombre de fantasía para el caso</small></label>

                    <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
                    
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label class="bmd-label-floating">Nombre empresa &nbsp;&nbsp;<small>Nombre de la empresa donde se llevó a cabo el caso</small></label>
                    <input type="text" name="company_name" class="form-control" value="{{ old('company_name') }}" required>
                    
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-3">
                <div class="form-group">
                    <label class="bmd-label-floating">Menciona en que porcentaje...</label>

                    <input type="number" name="percentage" class="form-control" id="percentage" value="{{ old('percentage') }}" required>
                    
                </div>
            </div>
            <div class="col-md-9">
                <div class="form-group">
                    <label class="bmd-label-floating">En que ayudo el dise;o.....</label>
                    <input type="text" name="result" id="result" class="form-control" value="{{ old('result') }}" required>
                    
                </div>
            </div>
        </div>


            <div>Seleccione sector y actividad de la empresa</div>

            <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                @foreach($sectors as $key => $sector)
                  <li class="nav-item">
                    <a class="nav-link  pills-sectors {{ $key == 0 ? 'active':''}}" id="pills-{{ $sector->id }}-tab" data-toggle="pill" href="#pills-{{ $sector->id }}" role="tab" aria-controls="pills-{{ $sector->id }}" aria-selected="true">{{ $sector->name }}</a>
                  </li>
                @endforeach
            </ul>
            <div class="tab-content" id="pills-tabContent">
                @foreach($sectors as $key => $sector)
                        <div class="tab-pane fade {{ $key == 0 ? 'show active':''}}" id="pills-{{ $sector->id }}" role="tabpanel" aria-labelledby="pills-{{ $sector->id }}-tab">
                            <div class="row sectors">
                                @foreach($sector->classifications()->get() as $classification)
                                <div class="col-md-3 col-sm-4">
                                    <div class="form-radio">
                                        <label class="form-radio-label">
                                            <input class="form-radio-input" type="radio" name="sector" id="{{$classification->classification}}" value="{{ $classification->id }}" />{{ $classification->classification }}</label>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                @endforeach
            </div>



        <div class="form-group mt-3">
            <label for="exampleMessage" class="bmd-label-floating">Cuéntanos en una frase de que se trata el caso</label>
            <input type="text" name="description" class="form-control" rows="4" value="{{ old('description') }}">
        </div>
        <div class="form-group">
            <label for="exampleMessage" class="bmd-label-floating">Cuéntanos con mas detalle el caso</label>
            <textarea type="textarea" name="long_description" class="form-control" rows="4">{{ old('long_description') }}</textarea>
        </div>


<div class="mb-3 dm-uploader" id="drag-and-drop-zone">
  <div class="form-row">
    <div class="col-md-9 col-sm-12 align-grid-r">
      <div class="from-group mb-2">
        <label>Agrega una imagen que represente el caso</label>
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
          <input type="file" id="file-input" name="image" />
        </div>
        <small class="status text-muted">Busca la imagen en tus archivos</small>
      </div>
    </div>
    <div class="col-md-3  d-md-block  d-sm-none align-grid">
      <img src="https://danielmg.org/assets/image/noimage.jpg?v=v10" alt="..." class="img-thumbnail w-100" id="imgSalida">
    </div>
  </div>
</div>

            
<h4>Selecciona a que servicio de los que prestas pertenece este caso de éxito</h4>
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
                <button type="submit" class="btn btn-primary btn-raised d-inline">
                    Enviar
                </button>
                <button class="btn btn-primary btn-raised d-inline" id="preview" data-toggle="modal" data-target="#previewModal" disabled="true">
                    Vista previa
                </button>
            </div>
        </div>
    </form
>
<div class="modal fade" id="previewModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content bigModal">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      <div class="modal-body">
        <div class="row">
            <div class="col-md-3">
                <div class="service">
                    <div class="corner"></div>
                        <div class="image-container op08">
                            <div class="small">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="text-instance-small percentage"></div>
                                    </div>
                                    <div class="col-sm-8 box-instance">
                                    <div class="row"> 
                                        <div class="percentage-instance-small">%</div>
                                        <div class="description-instance-small result"></div>
                                    </div>
                                    </div>
                                </div>
                            </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="service">
                    <div class="corner"></div>
                        <div class="image-container op08">
                            <div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="text-instance percentage"></div>
                                    </div>
                                    <div class="col-sm-8 box-instance">
                                    <div class="row"> 
                                        <div class="percentage-instance">%</div>
                                        <div class="description-instance result"></div>
                                    </div>
                                    </div>
                                </div>
                            </div>
                    </div>
                </div>
            </div>
        </div>

        <section>
            <div class="row">
                <div class="col-md-9">
                    <img class="image-container image-case" >
                    <div class="middle-case">
                            <div class="text-case"></div>
                    </div>
                </div>
                <div class="col-md-3">
                    <img class="w-100" src="{{ auth()->user()->instance()->url }}">
                    <a href="#!" class="btn btn-danger w-100 btn-company">Ver empresa</a>
                </div>
            </div>
        </section>
      </div>
    </div>
  </div>
</div>

    @else
    <h3>Has superado el máximo de casos para agregar, si deseas ingresar uno nuevo, elimina uno de los existentes.</h3>
    @endif
</div>

@include('partials/footer')

@endsection
