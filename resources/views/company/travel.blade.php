@extends('layouts.puente')
@section('title','Viaje')

@section('content')
<form method="post" action="{{ route('responses') }}">
    {{ csrf_field() }}
    <input type="hidden" name="company" value="{{ auth()->user()->id }}">
    <input type="hidden" name="survey" value="{{ $survey->id }}">
@foreach($survey->survey_questions()->get() as $key=>$question)
    <ul>
        <li>{{ $question->question->question }}</li>
        <ol>
            @foreach($question->question->response_choices()->get() as $response)
                <br>
                @switch($question->question->question_type_id)
                    @case(1)
                        <input type="checkbox" name="response[{{ $key }}][{{ $response->id}}]" value="1">{{ $response->response }}
                        @break
                    @case(2)
                        <input type="radio" name="response[{{ $key }}]" value="{{ $response->id }}">{{ $response->response }}
                        @break
                    @case(3)
                        {{ $response->response }}<input type="range" name="response[{{ $key }}][{{ $response->id}}]" value="1" min="1" max="7" >
                        @break
                @endswitch
            @endforeach
        </ol>
    </ul>
@endforeach
<button>Enviar</button>
</form>
@endsection
