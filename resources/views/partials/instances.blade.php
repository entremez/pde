<div class="row">
    @foreach($cases as $key =>$case)
    @php
        $class = "col-md-3 col-sm-6";
        $izquierda = "div2";
        $derecha = "div1";
        $porcentaje = "porcentaje";
        if($key == 0 || $key == 4){
            $class = "col-md-6 col-sm-6";
            $izquierda = "div2-grande";
            $derecha = "div1-grande";
            $porcentaje = "porcentaje-grande";
        }

    @endphp
    <div class="{{ $class }}">
        <div class="service">
            <a href="{{ route('case', $case->id) }}">
                    <div class="corner">{{ $case->classification->classification }}</div>
                <div class="image-container" style="background-image: linear-gradient(to bottom, rgba(0,0,0,0) 17%,rgba(0,0,0,0.54) 72%,rgba(0,0,0,0.65) 83%,rgba(0,0,0,0.65) 98%), url('{{url($case->image)}}')">

                <div class="container"> 
                        <div class="row-c">
                        <div class="{{$izquierda}}">{{ $case->percentage}}</div>
                        <div class="{{$derecha}}"><div class="{{$porcentaje}}">%</div><br>{{ $case->result }}</div>
                        </div>
                </div>
                        
                </div>
            </a>
        </div>
    </div>

    @endforeach
</div>