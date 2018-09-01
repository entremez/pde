@extends('layouts.puente')
@section('title','Encuestas')


@section('content')

@include('partials/menu')

<section class="surveys-container">
      <div class="container">
      <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Inicio</a></li>
          <li class="breadcrumb-item active" aria-current="page">Encuentas</li>
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
                      <h3 class="d-inline">Encuestas  </h3><a href="{{ route('surveys.create') }}" class="btn btn-primary mb-3">Crear Encuesta</a>
                      <table class="table">
                        <thead class="thead-dark">
                          <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nombre</th>
                            <th scope="col">Descripción</th>
                            <th scope="col">Preguntas</th>
                            <th scope="col"># Respuestas</th>
                            <th scope="col">Activar</th>
                            <th scope="col">Acciones</th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach ($surveys as $key=>$survey)
                          <tr data-id = "{{ $survey->id }}">
                              <th scope="row">{{ $key+1 }}</th>
                              <td>
                                    <a href="{{ route('surveys.show', $survey->id ) }}">
                                        {{ $survey->name }}
                                    </a>
                              </td>
                              <td>{{ $survey->description }}</td>
                              <td>{{ $survey->survey_questions()->get()->count() }}</td>
                              <td>{{ $survey->survey_responses()->get()->count() }}</td>
                              <td>
                                  <label class="switch">
                                      <input class="activate" type="checkbox" {{ $survey->active ? 'checked' : ''}}>
                                      <span class="slider round"></span>
                                  </label></td>
                              <td>
                                  <a href="{{ route('surveys.edit', $survey->id ) }}" class="btn btn-info">editar</a>
                                  <a href="{{ route('surveys.show', $survey->id ) }}" class="btn btn-primary">vista previa</a>
                                  <a href="#!" class = "btn btn-danger btn-destroy">Borrar</a>
                              </td>
                          </tr>
                          @endforeach
                        </tbody>
                      </table>
                  </div>
          </div>
      </div>
</section>

<form method="post" action="{{ route('surveys.destroy', ':SURVEY_ID') }}" id="form-destroy">
    {{ method_field('DELETE') }}
    {{ csrf_field() }}
</form>

<form method="post" action="{{ route('surveys.update', ':SURVEY_ID') }}" id="form-activate">
    {{ method_field('PATCH') }}
    {{ csrf_field() }}
    <input type="hidden" name="active" value="true">
</form>



@endsection