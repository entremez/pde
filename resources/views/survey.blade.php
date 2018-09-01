@foreach ($responses["qr"] as $json)
    <h5 id='{{ $json["question_id"] }}'>{{ $json["question"] }}</h5>
    <ul>
        @foreach($json["responses"] as $response)
                <div class='{{ $json["question_type"]}}'>
                    <label><input type='{{ $json["question_type"] }}' name="response[]" value='{{ $response["response_id"] }}'> {{ $response["response"] }}</label>
                </div>
        @endforeach
    </ul>
@endforeach