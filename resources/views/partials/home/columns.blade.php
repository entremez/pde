<div class="col-md-10 offset-md-1 section">
    <div class="row">
        <div class="col-md-6 vertical-line">
            <a href="{{ route('providers-list')}}" class="link"><h4 class="pb-4"><span class="first-color">Proveedores</span> <span class="secondary-color">de servicios de Diseño</span></h4></a>
            <div class="row">
            @foreach($providers as $provider)
                <div class="col-md-6 ">
                    <a href="{{ route('provider', $provider->id) }}"><div class="image-container image-column" style="background-image: url({{ $provider->logo }});"></div></a>
                </div>
                <div class="col-md-6 mb-3">
                    <a href="{{ route('provider', $provider->id) }}" class="link"><h6 class="provider-title">{{ $provider->name }}</h6></a>
                    <h6 class="provider-services">Servicios: {{ $provider->all_services }}</h6>
                </div>
            @endforeach
            </div>
            <a class="btn btn-danger btn-block mt-5" href="{{ route('providers-list')}}">Más proveedores de diseño</a>
        </div>
        <div class="col-md-6">
            <h4 class="pb-4"><span class="first-color">Documentos</span> <span class="secondary-color">de interes</span></h4>
            <div class="row">
            @foreach($providers as $provider)
                <div class="col-md-6 ">
                    <a href="#!"><div class="image-container  image-column" style="background-image: url(https://picsum.photos/1000/400?image={{ rand(1,500)}});"></div></a>
                </div>
                <div class="col-md-6 mb-3">
                    <h6 class="provider-title">Título del documento</h6>
                    <h6>Autor y año de edición</h6>
                    <h6>Ciudad</h6>
                </div>
            @endforeach
            </div>
            <button class="btn btn-danger btn-block mt-5">Documentos</button>
        </div>
    </div>
</div>
