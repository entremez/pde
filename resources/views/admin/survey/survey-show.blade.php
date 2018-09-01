@extends('layouts.puente')
@section('title','Encuestas')

@section('content')

@include('partials/menu')


<section class="surveys-container">
<div class="container">

<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Inicio</a></li>
    <li class="breadcrumb-item"><a href="{{ route('surveys.index') }}">Encuestas</a></li>
    <li class="breadcrumb-item active" aria-current="page"> Encuesta: {{ $survey->name}}</li>
</ol>
    @if(Session::has( 'success' ))
            <div class="alert alert-success">
                <button type="button" class="close" aria-label="Close" data-dismiss="alert">
                  <span aria-hidden="true">&times;</span>
                </button>
                <ul>
                    {{ Session::get( 'success' ) }}
                </ul>
            </div>
    @endif

    <div class="row">
            <div class="col-md-12">
                <div class="row mb-3">
                    <h3>{{ $survey->name}}  </h3>
                    <form method="get" action="{{ route('questions.create', $survey->id) }}">
                        <input type="hidden" name="survey" value="{{ $survey->id}}">
                    </form>
                        <button class="btn btn-primary ml-3" data-toggle="modal" data-target="#addQuestion">Agregar pregunta</button>
                        <button class="btn btn-info ml-3" data-toggle="modal" data-target="#preview">Vista previa</button>
                </div>
                <table class="table table-bordered">
                  <thead class="thead-dark">
                    <tr>
                      <th>#</th>
                      <th>Pregunta</th>
                      <th>Tipo de pregunta</th>
                      <th>Acciones</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($survey->survey_questions()->orderBy('order')->get() as $key=>$question)
                    <tr>
                        <td>{{ $key+1 }}</td>
                        <td>
                            {{ $question->question()->get()->first()->question }}
                            <br>
                            @if($question->question()->get()->first()->response_choices()->get()->count()>0)
                                <table class="table mt-3">
                                    <thead class="thead-dark">
                                        <tr>
                                          <th>#</th>
                                          <th>Respuesta</th>
                                          <th>Peso</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($question->question()->get()->first()->response_choices()->get() as $key2=>$response)
                                    <tr>
                                        <td>{{ $key2+1 }}</td>
                                        <td>{{ $response->response }}</td>
                                        <td>{{ $response->weight }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                                </table>
                            @endif
                            <form method="get" action="{{ route('response_choices.index') }}">
                                <input type="hidden" name="question" value="{{ $question->question_id }}">
                                <button class="btn btn-info">
                                    @if($question->question()->get()->first()->response_choices()->get()->count()>0)
                                        Agregar o gestionar respuestas
                                    @else
                                        Agregar respuestas
                                    @endif
                                </button>
                            </form>
                        </td>
                        <td>{{ $question->question()->get()->first()->question_type()->get()->first()->type }}</td>
                        <td>&%$</td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
            </div>
    </div>
</div>

</section>

<div class="modal fade" id="addQuestion" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Agregar pregunta a {{ $survey->name }}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="POST" action="{{ route('questions.store') }}">
          <div class="modal-body">
                {{ csrf_field() }}
                <input type="hidden" name="survey" value="{{ $survey->id }}">
                <div class="form-group">
                    <label for="question">Pregunta</label>
                    <input type="text" class="form-control" id="question" placeholder="Pregunta" name="question" value="{{ old('question') }}">
                </div>
                <div class="form-group">
                    <label for="description">Tipo de pregunta</label>
                    <select class="custom-select" name="type">
                        <option selected>Seleccionar</option>
                        @foreach(App\QuestionType::get() as $type)
                        <option value="{{ $type->id }}" {{ (old('type') == $type->id ? 'selected':'') }}>{{ $type->type }}</option>
                        @endforeach
                    </select>
                </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            <button type="submit" class="btn btn-primary">Agregar</button>
          </div>
      </form>
    </div>
  </div>
</div>


@include('survey-modal')


@endsection