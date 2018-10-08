@foreach ($responses["qr"] as $json)
<div>
    <h5 id='{{ $json["statement_id"] }}'>{{ $json["statement"] }}</h5>
    <ul>
        @foreach($json["options"] as $option)
        @php
            if($json["statement_type"] == "affirmation"){
                $type = "affirmation";
            }else{
                $type = $json["statement_type"];
            }
        @endphp
                <div class='{{ $json["statement_type"]}}'>
                    <label><input type='{{ $type }}' name="option[]" value='{{ $option["option_id"] }}'> {{ $option["option"] }}</label>
                </div>
        @endforeach
    </ul>
</div>
@endforeach