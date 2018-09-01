<div class="col-md-10 offset-md-1">
    <section class="columns">
        <div class="row">
            <div class="col-md-6">
                <h4 class="pb-4"><span class="first-color">Proveedores</span> <span class="secondary-color">de servicios de Diseño</span></h4>
            </div>
            <div class="col-md-6">
                <h4 class="pb-4"><span class="first-color">Documentos</span> <span class="secondary-color">de interes</span></h4>
            </div>
        </div>
        <div class="row pb-6">
            @foreach($providers as $provider)
                <div class="col-md-3">
                    <div class="image-container" style="background-image: url({{ $provider->logo }});"></div>
                </div>
                <div class="col-md-3 vertical-line">
                    <h6 class="provider-title">{{ $provider->name }}</h6>
                    <h6 class="provider-services">Servicios: {{ $provider->all_services }}</h6>
                </div>
                <div class="col-md-3">
                    <div class="image-container" style="background-image: url(https://picsum.photos/223/166?random);"></div>
                </div>
                <div class="col-md-3">
                    <h6>Autor y año de edición</h6>
                    <h6>Ciudad</h6>
                </div>
            @endforeach
        </div>
        <div class="row">
            <div class="col-md-6">
                <button class="btn btn-danger btn-block">MÁS PROVEEDORES DE DISEÑO</button>
            </div>
            <div class="col-md-6">
                <button class="btn btn-danger btn-block">DOCUMENTOS</button>
            </div>
        </div>
    </section>
</div>