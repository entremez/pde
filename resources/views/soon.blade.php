@extends('layouts.puente')
@section('title', 'Puente Diseño Empresa')

@section('headers')
<meta name="description" content="El diseño mejora tu negocio. Pronto podrás saber cómo.">

<!-- Google / Search Engine Tags -->
<meta itemprop="name" content="Puente Diseño Empresa">
<meta itemprop="description" content="El diseño mejora tu negocio. Pronto podrás saber cómo.">
<meta itemprop="image" itemprop="image" content="http://www.puentedisenoempresa.cl/images/logo-bp-0051.png">

<!-- Facebook Meta Tags -->
<meta property="og:url" content="http://www.puentedisenoempresa.cl">
<meta property="og:type" content="website">
<meta property="og:title" content="Puente Diseño Empresa">
<meta property="og:description" content="El diseño mejora tu negocio. Pronto podrás saber cómo.">
<meta property="og:image" itemprop="image" content="http://www.puentedisenoempresa.cl/images/logo-bp-0051.png">

<!-- Twitter Meta Tags -->
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="Puente Diseño Empresa">
<meta name="twitter:description" content="El diseño mejora tu negocio. Pronto podrás saber cómo.">
<meta name="twitter:image" itemprop="image" content="http://www.puentedisenoempresa.cl/images/logo-bp-0051.png">
@endsection

@section('content')
<div class="col-md-10 offset-md-1 my-5 text-center soon" >

		<div class="col-md-6 offset-md-3">
			<img src="{{ asset('images/logo-bp-0051.png') }}" alt="logo puente diseño empresa" class="img-soon">

			<p class="mt-4 ls">El diseño mejora tu negocio. Pronto podrás saber cómo.</p>
		</div>
	<div class="row mt-5">
		<div class="col-md-7 mx-auto">
			      <div class="row footer-logos mb-3">   
                    <div class="logof">
                        <img src="{{ asset('images/footer/uc.png') }}">
                    </div>
                    <div class="logof">
                        <img src="{{ asset('images/footer/disenouc.png') }}">
                    </div>
                    <div class="logof">
                        <img src="{{ asset('images/footer/chilecreativo.png') }}">
                    </div>
                    <div class="logof">
                        <img src="{{ asset('images/footer/corfo.png') }}">
                    </div>  
                </div>
                <div class="row footer-logos mb-3">
                    <div class="logof">
                        <img src="{{ asset('images/footer/sofofa.png') }}">
                    </div>  
                    <div class="logof">
                        <img src="{{ asset('images/footer/minculturas.png') }}">
                    </div>
                    <div class="logof">
                        <img src="{{ asset('images/footer/minturismo.png') }}">
                    </div>
                    <div class="logof"  style="width: 25%">
                        
                    </div>
                </div>
                <div class="row footer-logos">
                    <div class="logof">
                        <img src="{{ asset('images/footer/colegiodiseno.png') }}">
                    </div>
                    <div class="logof">
                        <div class="mma">
                        <img src="{{ asset('images/footer/chilediseno.png') }}">
                        </div>
                    </div>
                    <div class="logof" style="width: 50%">
                        
                    </div>
                </div>
                </div>
		</div>
	</div>
</div>



@endsection