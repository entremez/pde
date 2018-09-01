@extends('layouts.puente')
@section('title','Respuestas')

@section('content')
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Inicio</a></li>
    <li class="breadcrumb-item active" aria-current="page"><a href="{{ route('surveys.index') }}">Encuentas</a></li>
    <li class="breadcrumb-item active" aria-current="page" ><a href="{{ route('surveys.show', $question->survey_questions()->get()->first()->survey()->get()->first()->id ) }}">Encuesta: {{ $question->survey_questions()->get()->first()->survey()->get()->first()->name }}</a></li>
    <li class="breadcrumb-item active" aria-current="page">Respuestas</li>
</ol>
<div class="container">
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
                <h3>Respuestas a pregunta: {{ $question->question }}</h3>
                    <input type="hidden" name="question" value="{{ $question->id }}">
                    <button class="btn btn-primary" data-toggle="modal" data-target="#addResponse">Agregar respuesta</button>
                <table class="table mt-3">
                  <thead class="thead-dark">
                    <tr>
                      <th scope="col">#</th>
                      <th scope="col">Respuesta</th>
                      <th scope="col">Peso</th>
                      <th scope="col">Acciones</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($question->response_choices()->get() as $key=>$response)
                    <tr data-id="{{ $response->id }}">
                        <th scope="row">{{ $key+1 }}</th>
                        <td>{{ $response->response }}</td>
                        <td>{{ $response->weight }}</td>
                        <td>
                            <a href="#!" class = "btn btn-danger btn-destroy" data-target="responses">Borrar</a>
                            <button class="btn btn-primary" data-toggle="modal" data-target="#edit-{{ $response->id }}">Editar</button>
                        </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
            </div>
    </div>
</div>


<!-- Modal Create -->
<div class="modal fade" id="addResponse" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Agregar respuesta a {{ $question->question }}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="POST" action="{{ route('response_choices.store') }}">
          <div class="modal-body">
                {{ csrf_field() }}
                <input type="hidden" name="question" value="{{ $question->id }}">
                <div class="form-group">
                    <label for="response">Respuesta</label>
                    <input type="text" class="form-control" id="response" placeholder="Respuesta" name="response" value="{{ old('response') }}" required >
                </div>
                <div class="form-group">
                    <label for="weight">Peso de respuesta</label>
                    <input type="number" class="form-control" id="weight" placeholder="Peso" name="weight" value="{{ old('weight') }}" required >
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

<!-- Modal Edit-->

@foreach($question->response_choices()->get() as $response)
<div class="modal fade" id="edit-{{ $response->id }}" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Editar respuesta a {{ $question->question }}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="post" action="{{ route('response_choices.update', $response->id) }}">
          <div class="modal-body">
                {{ csrf_field() }}
                {{method_field('PATCH')}}
                <div class="form-group">
                    <label for="response">Respuesta</label>
                    <input type="text" class="form-control" id="response" placeholder="Pregunta" name="response" value="{{ $response->response }}" required >
                </div>
                <div class="form-group">
                    <label for="weight">Peso de respuesta</label>
                    <input type="number" class="form-control" id="weight" placeholder="Peso" name="weight" value="{{ $response->weight }}" required >
                </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            <button type="submit" class="btn btn-primary">Editar</button>
          </div>
      </form>
    </div>
  </div>
</div>

<form method="post" action="{{ route('response_choices.destroy', ':SURVEY_ID') }}" id="form-destroy">
    {{ csrf_field() }}
    {{method_field('DELETE')}}
</form>
@endforeach

@endsection