<div class="row mt-5">
	<div class="response-header" style="background-image: url('{{ asset('/images/FONDO-diagonal-titulo.png') }}'); ">
	    <div class="display-header-title">Viaje del uso de diseño</div>
	</div>
	<div class="col-md-12 px-5 mt-5">
		<h4 class="font-weight-bold">Si no sabes qué implica la contratación de diseño te recomendamos mirar lo siguiente.</h4>
		<h4 class="mt-3">En términos generales, un servicio de diseño contempla las siguientes macro-etapas:</h4>
		<span class="span-stages">(Si quieres indagar en cada una puedes desplegar cada pestaña)</span>
	</div>
</div>
<div class="row mt-5">
	@foreach($stages as $key1 => $stage)
    <div class="stage w-100 stage-response">
        <span class="stage-name">{{ $key1 +1}}. {{ $stage->name }}</span>
        <div><i class="fas fa-angle-down" style="
												    font-size: 2.5rem;
													color: gray;"></i></div>
    </div>
			<div class="titles-response">
            @php $count = 1; @endphp
                @foreach($stage->titles as $title)
		            <div class="position-relative">    
		                <div class="sub-stage" style="border-top-color: {{ $title->border  }} ;background-color: {{ $title->background }};
						background-image: url('{{ asset('images/TRIANGULO-SUPERIOR-DERECHA.png')}}') ,url('{{ asset('images/TRIANGULO-INFERIOR-DERECHA.png')}}')">
		                    <div class="sub-stage-name"><span>{{ $key1 +1}}.{{ $count }} {{ $title->name }}</span></div>
		                    @php $count++; @endphp
		                    <div class="sub-stage-image"><img src="{{ $title->image() }}" alt="" class="w-100"></div>
		                </div>
		                <div class="arrow-down"><i class="fas fa-angle-down"></i></div>
		                <div class="arrow-up"><i class="fas fa-angle-up"></i></div>
                	</div>
					<div class="stage-content">
		                <div class="row">
		                	@foreach($title->bodies as $key => $body)
		                    <div class="col-md-4 border-{{ $key }}">
		                        <div class="w-title" style="background-color: {{ $body->sentence->background }}"><span>{{ $body->sentence->sentence }}</span></div>
		                    </div>
							@endforeach
		                	@foreach($title->bodies as $key => $body)
		                    <div class="col-md-4  border-{{ $key }}">
		                        <div class="w-body h-100" style="background-color: {{ $body->background }}">{{ $body->body }}</div>
		                    </div>
							@endforeach      
		                </div>
		             </div>
                @endforeach
            </div>
    @endforeach
</div>