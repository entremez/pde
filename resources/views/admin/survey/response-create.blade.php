@extends('layouts.puente')
@section('title','Agregar pregunta')

@section('content')
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Inicio</a></li>
    <li class="breadcrumb-item"><a href="{{ route('surveys.index') }}">Encuestas</a></li>
    <li class="breadcrumb-item active" aria-current="page">Agregar respuesta a {{ $question->question }}</li>
</ol>

<div class="container">
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
    <form method="POST" action="{{ route('questions.store') }}">
        {{ csrf_field() }}
        <input type="hidden" name="survey" value="{{ $question->id }}">
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
        <button type="submit" class="btn btn-primary">Agregar</button>
    </form>
</div>
@endsection
