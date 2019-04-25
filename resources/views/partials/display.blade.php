            <div class="display mt-5">
                <div class="display-header" style="background-image: url('{{ asset('/images/FONDO-diagonal-titulo.png') }}'); ">
                    <div class="display-header-title">Proyecto de Diseño</div>
                    <span class="display-header-subtitle">ETAPAS Y CONSIDERACIONES</span>
                </div>
                @php $count = 1; @endphp
                @foreach($stages as $stage)
	                <div class="stage">
	                    <span class="stage-name">{{ $stage->name }}</span>
	                </div>
	                @foreach($stage->titles as $title)
			            <div class="position-relative">    
			                <div class="sub-stage" style="border-top-color: {{ $title->border  }} ;background-color: {{ $title->background }};
							background-image: url('{{ asset('images/TRIANGULO-SUPERIOR-DERECHA.png')}}') ,url('{{ asset('images/TRIANGULO-INFERIOR-DERECHA.png')}}')">
			                    <div class="sub-stage-name"><span>{{ $count }}. {{ $title->name }}</span></div>
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
	            @endforeach
            </div>