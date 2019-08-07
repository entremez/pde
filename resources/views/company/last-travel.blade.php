<div class="row">
		<div class="response-header" style="background-image: url('{{ asset('/images/FONDO-diagonal-titulo.png') }}'); ">
		    <div class="display-header-title">Resultado de Evaluación</div>
		</div>
	</div>
<div class="row">
	<div class="col-md-7 pl-5">
		<p class="text-left mt-3" style="font-size: 1.3rem">{{ $company->lastTravelDate() }}</p>
		<p class="text-left stairs-phrase">Actualmente {{ $company->stairs()[0] }}</p>
		<p class="same-level">El {{ $company->sameLevel() }}% de las empresas inscritas en el Puente están en tu mismo nivel.</p>
	</div>
	<div class="col-md-5 px-5 mt-4">
		<div class="text-right">
			<img style="width: 100%" src="{{ asset('/images/stairs/'.$company->stairs()[1]) }}" alt="">
		</div>
	</div>
</div>
<div class="row mt-5">
	<div class="response-header" style="background-image: url('{{ asset('/images/FONDO-diagonal-titulo.png') }}'); ">
	    <div class="display-header-title">Recomendaciones</div>
	</div>
	<div class="col-md-8 pl-5 mt-5">
		<p class="text-left stairs-phrase"><span class="font-weight-bold">Si quieres mejorar tu negocio</span> mediante el uso de diseño en el ámbito de {{ $company->recomendation()[0]}} te recomendamos utilizar <span class="font-weight-bold">{{ App\Service::getNames(json_decode($company->recomendation()[1])) }}.</span>
		</p>
	</div>
	<div class="col-md-4 px-5 mt-5">
		<div class="text-right">
			<img style="width: 100%" src="{{ $company->recomendation()[2] }}" alt="">
		</div>		
	</div>
	
</div>
<div class="row mt-5">
	<div class="response-header" style="background-image: url('{{ asset('/images/FONDO-diagonal-titulo.png') }}'); ">
	    <div class="display-header-title">Proveedores</div>
	</div>
	<div class="col-md-12 px-5 mt-5">
		<h4>Los proveedores presentes en esta plataforma que ofrecen este tipo de servicio son:</h4>
	</div>


		@foreach($company->getProviders($company->recomendation()[1]) as $key => $provider)

	        <div class="col-md-3 col-sm-6">
	            <div class="service">
	                <a href="{{ route('provider', $provider->id) }}" target="_blank">
	                    <div class="image-container provider-image-solo" style="background-image: url('{{url($provider->imagen_logo)}}')" title="{{$provider->name}}">         
	                    </div>
	                </a>
	            </div>
	        </div>

		@endforeach

	<div class="row w-100 mt-3">
		<div class="col-md-12 view-more-recommendations">
			<a href="{{ route('providers-list-filtered',[$company->recomendation()[1]]) }}" target="_blank" class="btn btn-danger btn-view-more-service">Ver más proveedores <i class="fas fa-chevron-right"></i></a>
		</div>
	</div>
</div>

@include('/partials/display')

<div class="row">
	<div class="response-header" style="background-image: url('{{ asset('/images/FONDO-diagonal-titulo.png') }}'); ">
	    <div class="display-header-title">Formas de financiamiento</div>
	</div>
	<div class="col-md-12 px-5 mt-5">
		<h4>Cifras extranjeras muestran que <span class="font-weight-bold"> el retorno del diseño es aproximadamente 20 veces la inversión.</span><br> Invertir en diseño te conviene.</h4>

		<h4>Si no cuentas con los recursos existen múltiples instrumentos públicos y privados que podrían ayudarte a financiar diseño. Entre ellos están:</h4>
		
		<div class="row">
		@foreach($fundings as $funding)
	        <div class="col-md-3 col-sm-6">
	            <div class="service">
	                <a href="{{ $funding->web }}" target="_blank">
						<img src="{{ asset('/images/fundings/'.$funding->image) }}" alt="" class="w-100">
	                </a>
	            </div>
	        </div>
		@endforeach
		</div>
    	<div class="row w-100 mt-3">
    		<div class="col-md-12 w-100">
    			<div class="btn btn-danger btn-view-more-service">Ver más fuentes de financiamiento <i class="fas fa-chevron-right"></i></div>
    		</div>
    	</div>
	</div>
</div>