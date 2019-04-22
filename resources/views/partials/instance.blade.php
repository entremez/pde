<div class="service">
    <a href="{{ route('case', $case->id) }}">
            <div class="corner">{{ $case->classification->classification }}</div>
        <div class="image-container" style="background-image: linear-gradient(to bottom, rgba(0,0,0,0) 17%,rgba(0,0,0,0.54) 72%,rgba(0,0,0,0.65) 83%,rgba(0,0,0,0.65) 98%), url('{{url($case->my_image)}}')">

        <div class="container"> 
                <div class="row-c">
                <div class="div2">{{ $case->quantity}}</div>
                <div class="div1">
                	<div class="porcentaje">
                		{{  $case->unit }}
                	</div>
                	<div class="sentence">
                		{{ $case->sentence }}
                	</div>
                </div>
                </div>
        </div>
                
        </div>
    </a>
</div>