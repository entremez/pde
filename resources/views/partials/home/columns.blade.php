<div class="col-md-10 offset-md-1 section margin-bottom-3">
    <div class="row">
        <div class="col-md-6 vertical-line">
            <div class="section-title">
            <a href="{{ route('providers-list')}}" class="link"><h4 class="pb-4"><span class="first-color">Proveedores</span> <span class="secondary-color">de servicios de Diseño</span></h4></a>
            </div>
            <div class="row">
            @foreach($providers as $provider)
                <div class="col-md-6 ">
                    <a href="{{ route('provider', $provider->id) }}"><div class="image-container image-column" style="background-image: url('{{ $provider->imagen_logo }}');"></div></a>
                </div>
                <div class="col-md-6 mb-3 text-center-mobile">
                    <a href="{{ route('provider', $provider->id) }}" class="link"><h6 class="provider-title">{{ $provider->name }}</h6></a>
                    <h6 class="provider-services">Servicios: {{ $provider->all_services }}</h6>
                </div>
            @endforeach
            </div>
            <a class="btn btn-danger btn-block mt-5 margin-top-0" href="{{ route('providers-list')}}">Más proveedores de diseño</a>
        </div>
        <div class="col-md-6 recursos">
            <h4 class="pb-4"><span class="first-color">Recursos</span> <span class="secondary-color">de interes</span></h4>
            <div class="row">
            @foreach($providers as $provider)
                <div class="col-md-6 ">
                    <div class="image-container  image-column"></div>
                </div>
                <div class="col-md-6 mb-3">

                </div>
            @endforeach
            </div>
            <button class="btn btn-danger btn-block mt-5">Más recursos</button>
        </div>
    </div>
</div>
