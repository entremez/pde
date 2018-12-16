@extends('layouts.puente')
@section('title', 'PDE | Editar '.$case->name)

@section('content')

@include('partials/menu')


<div class="after-menu"></div>

<div class="col-md-10 offset-md-1">
    <h2 class="text-center mt-4 mb-4">Editar caso</h2>
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

    <form class="contact-form" method="POST" action="{{ route('cases.update', $case->id ) }}" enctype="multipart/form-data" id="edit-form">
        {{ csrf_field() }}
        {{ method_field('PUT') }}

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label class="bmd-label-floating">Nombre&nbsp;&nbsp;<small>(Nombre de fantasía para el caso)</small></label>

                    <input type="text" name="name" id="name" class="form-control" value="{{ $case->name, old('name') }}" required>
                    
                </div>
            </div>


            <div class="col-md-3">
                <div class="form-group">
                    <label class="bmd-label-floating">Año de realización</label>

                    <input type="number" name="year" class="form-control" id="year" value="{{ $case->year,old('year') }}" min="1906" max="{{ date('Y') }}" required>
                    
                </div>
            </div>

            <div class="col-md-3">
                <div class="form-group">
                <label for="region">Región &nbsp;<small>(Donde se implementó el caso)</small></label>
                    <select class="form-control" id="region" name="region">
                      <option value="">Seleccionar...</option>
                        @foreach($cities as $city)
                            <option value="{{ $city->id }}" {{ $city->id == $case->city_id ? 'selected': '' }}>{{ $city->region }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label class="bmd-label-floating">Nombre empresa &nbsp;<small>(Donde se llevó a cabo el caso)</small></label>
                    <input type="text" name="company_name" class="form-control" value="{{ $case->company_name, old('company_name') }}" required>    
                </div>
            </div>



            <div class="col-md-6">
                <div class="form-group">
                    <label class="bmd-label-floating">Cantidad de trabajadores &nbsp;<small>(De la empresa donde se realizó el caso)</small></label>
                    <select class="form-control" id="employees" name="employees" required>
                      <option value="">Seleccionar...</option>
                        @foreach($employees as $employee)
                            <option value="{{ $employee->id }}" {{ $employee->id == $case->employees_range ? 'selected': '' }}>{{ $employee->range }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
                
        </div>

        <label class="bmd-label-floating mb-2 mt-4">Construye la frase principal del impacto de tu caso</label>
        <div class="row">
            <div class="col-md-3">
                <div class="form-group">
                    <small>Cantidad</small>

                    <input type="number" name="quantity" class="form-control" id="quantity" value="{{ $case->quantity, old('quantity') }}" min="1" required>
                    
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <small>Unidad (%, $, X, +)</small>

                    <input type="text" name="unit" class="form-control" id="unit" value="{{  $case->unit, old('unit') }}">
                    
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <small>Frase</small>
                    <input type="text" name="sentence" id="sentence" class="form-control" value="{{  $case->sentence, old('sentence') }}" required>
                    
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-6 docepx">
                    Ejemplos:
                <div class="row">
                    <div class="col-2">
                        <p>Cantidad</p>
                        3000 <br>
                        200 <br>
                        2 <br>
                        50 <br>
                        10 <br>
                    </div>
                    <div class="col-2">
                        <p>Unidad</p>
                        MM CLP <br>
                        % <br>
                        x <br>
                        + <br>
                        <br>
                    </div>
                    <div class="col-8">
                        <p>Frase</p>
                        de ahorro anual <br>
                        de aumento de ventas en 10 meses <br>
                        aumentó las visitas al museo <br>
                        personas usaron los servicios de caridad <br>
                        nuevas creaciones colaborativas <br>   
                    </div>
                </div>
            </div>
        </div>


            <div class="mb-2 mt-4">Seleccione sector y actividad de la empresa</div>
            <div class="errorSector"></div>

            <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                @foreach($sectors as $key => $sector)
                  <li class="nav-item">
                    <a class="nav-link  pills-sectors {{ $key == $case->classification()->first()->sector()->first()->id -1 ? 'active':''}} docepx" id="pills-{{ $sector->id }}-tab" data-toggle="pill" href="#pills-{{ $sector->id }}" role="tab" aria-controls="pills-{{ $sector->id }}" aria-selected="true">{{ $sector->name }}</a>
                  </li>
                @endforeach
            </ul>
            <div class="tab-content" id="pills-tabContent">
                @foreach($sectors as $key => $sector)
                        <div class="tab-pane fade {{ $key == $case->classification()->first()->sector()->first()->id -1 ? 'show active':''}}" id="pills-{{ $sector->id }}" role="tabpanel" aria-labelledby="pills-{{ $sector->id }}-tab">
                            <div class="row sectors">
                                @foreach($sector->classifications()->get() as $classification)
                                <div class="col-md-3 col-sm-4">
                                    <div class="form-radio">
                                        <label class="form-radio-label" id="classification" >
                                            <input class="form-radio-input {{ $case->classification_id == $classification->id ? 'seleccionado':'' }}" type="radio" name="sector" id="{{$classification->classification}}" value="{{ $classification->id }}" {{ $case->classification_id == $classification->id ? 'checked':'' }} /><span class="docepx text-top">&nbsp;{{ $classification->classification }}</span></label>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                @endforeach
            </div>


        <div class="form-group mt-4">
            <label for="" class="bmd-label-floating">Cuéntanos el caso con mas detalle</label>
            <textarea type="textarea" name="long_description" class="form-control" rows="4">{{ $case->long_description, old('long_description') }}</textarea>
        </div>

        <div class="form-group mt-4">
            <label for="quote" class="bmd-label-floating">Cita del cliente que muestre los efectos del caso</label>
            <input type="text" name="quote" id="quote" class="form-control" value="{{ $case->quote, old('quote') }}" />
        </div>


<div class="mb-3 dm-uploader" >
  <div class="form-row">
    <div class="col-md-9 col-sm-12 align-grid-r">
      <div class="from-group mb-2">
        <label>Agrega una imagen que represente el caso&nbsp;&nbsp;&nbsp;<small>(Formatos permitidos: jpeg, png, bmp, gif o svg)</small></label>
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
        <div role="button" class="btn btn-primary mr-2">
          Examinar archivos
          <input type="file" id="file-input" name="image" />
        </div>
        <small class="status text-muted">Busca la imagen en tus archivos</small>
      </div>
    </div>
    <div class="col-md-3  d-md-block  d-sm-none align-grid">
      <img src="{{url($case->image)}}" alt="sin imagen" class="img-thumbnail w-100" id="imgSalida">
    </div>
  </div>
</div>


<div class="mb-3 dm-uploader">
  <div class="form-row">
    <div class="col-md-9 col-sm-12 align-grid-r">
      <div class="from-group mb-2">
        <label>Agrega el logo de la empresa donde se llevó a cabo el caso&nbsp;&nbsp;&nbsp;<small>(Formatos permitidos: jpeg, png, bmp, gif o svg)</small></label>
        <div class="errorLogoCompany"></div>
        <input type="text" class="form-control" aria-describedby="fileHelp" placeholder="Selecciona una imagen..." readonly="readonly" id="image-data-company" />


      </div>
      <div class="form-group">
        <div role="button" class="btn btn-primary mr-2">
          Examinar archivos
          <input type="file" id="file-input-company" name="company-logo" />
        </div>
        <small class="status text-muted">Busca la imagen en tus archivos</small>
      </div>
    </div>
    <div class="col-md-3  d-md-block  d-sm-none align-grid">
      <img src="{{url($case->image_company)}}" alt="sin imagen" class="img-thumbnail w-100" id="imgCompany">
    </div>
  </div>
</div>

    <div class="servicios">          
        <span>Selecciona a que servicio de los que prestas pertenece este caso de éxito</span>
            <div class="errorTxt"></div>
        <div class="row mt-3">
            @foreach($services as $service)
            <div class="col-md-3 col-sm-4">
                <div class="form-check">
                    <label class="form-check-label">
                        <input class="form-check-input" type="checkbox" name="service[]" value="{{ $service->id }}" @foreach($case->services()->get() as $service_case)
                            {{ $service_case->service_id == $service->id ? 'checked':''  }}
                        @endforeach
                        >{{ $service->name }}
                        <span class="form-check-sign">
                            <span class="check"></span>
                        </span>
                    </label>
                </div>
            </div>
            @endforeach
        </div>
    </div> 
        <br>
        <div class="row">
            <div class="col-md-4 ml-auto mr-auto text-center">
                <button type="submit" class="btn btn-primary btn-raised d-inline">
                    Guardar cambios
                </button>
                <button class="btn btn-primary btn-raised d-inline" id="preview-edit" data-toggle="modal" data-target="#previewModal" >
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
            <span>Visualización del caso en los catalogos de casos</span>
        <div class="row">
            <div class="col-md-4">
                <div class="service">

                    <div class="corner"></div>
                        <div class="image-container">

                        <div class="container"> 
                            <div class="row-c">
                                <div class="div2"></div>
                                <div class="div1"></div>
                            </div>
                        </div>
                            
                    </div>

                </div>
            </div>
            <div class="col-md-8">
                <div class="service">

                    <div class="corner"></div>
                        <div class="image-container">

                        <div class="container"> 
                            <div class="row-c">
                                <div class="div2-grande"></div>
                                <div class="div1-grande"></div>
                            </div>
                        </div>
                            
                    </div>

                </div>
            </div>
        </div>

        <section>

            <span>Visualización del caso en la página particular del caso</span>
            <div class="row">
                <div class="col-md-12">
                    <img class="image-container image-case" >
                    <div class="middle-case">
                            <div class="text-case"></div>
                    </div>
                </div>
            </div>
        </section>

        <div class="row buttons-preview">
            <button type="button" class="btn btn-danger" data-dismiss="modal" aria-label="Close">Editar</button>
            <button id="submit-create-case" class="btn btn-danger">Guardar cambios</button>
        </div>
      </div>
    </div>
  </div>
</div>


</div>

@include('partials/footer')

@endsection
