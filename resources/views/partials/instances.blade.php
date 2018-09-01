

        <div class="row">
        @foreach($cases as $key =>$case)
        @php
            $class = "col-md-3 col-sm-6";
            $textInstance = "text-instance-small";
            $percentageInstance = "percentage-instance-small";
            $descriptionIntance = "description-instance-small";
            if($key == 0 || $key == 4){
                $class = "col-md-6 col-sm-6";
                $textInstance = "text-instance";
                $percentageInstance = "percentage-instance";
                $descriptionIntance = "description-instance";
            }
        @endphp
        <div class="{{ $class }}">
            <div class="service">
                <a href="{{ route('case', $case->id) }}">
                    <div class="image-container" style="background-image: url(https://picsum.photos/800/600?image={{ $case->id }})">
                        <div class="corner">{{ $case->classification }}</div>
                        <div class="middle-service">
                            <div class="{{ $textInstance }}">19</div>
                            <div class="{{ $percentageInstance }}">%</div>
                            <div class="{{ $descriptionIntance }}">{{ $case->description }}</div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
        @endforeach
    </div>