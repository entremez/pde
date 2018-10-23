<div class="row">
    @foreach($cases as $key =>$case)
    @php
        $class = "col-md-3 col-sm-6";
        $textInstance = "text-instance-small";
        $percentageInstance = "percentage-instance-small";
        $descriptionIntance = "description-instance-small";
        $small = "small";
        if($key == 0 || $key == 4){
            $class = "col-md-6 col-sm-6";
            $textInstance = "text-instance";
            $percentageInstance = "percentage-instance";
            $descriptionIntance = "description-instance";
            $small = "";
        }
    @endphp
    <div class="{{ $class }}">
        <div class="service">
            <a href="{{ route('case', $case->id) }}">
                    <div class="corner">{{ $case->classification }}</div>
                <div class="image-container op08" style="background-image: url(https://picsum.photos/800/600?image={{ $case->id }})">
                    <div class=" {{ $small }}">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="{{ $textInstance }}">{{ $case->percentage}}</div>
                            </div>
                            <div class="col-sm-8 box-instance">
                            <div class="row"> 
                                <div class="{{ $percentageInstance }}">%</div>
                                <div class="{{ $descriptionIntance }}">{{ $case->result }}</div>
                            </div>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </a>
        </div>
    </div>
    @endforeach
</div>