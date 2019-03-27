    <div class="row mt-5">
    	<div class="col">
    		<h4>Proveedores con cambios (<span id="number_providers_buffered">{{ $providersBuffered->count() }}</span>) PRONTO!<span id="providers_in_buffer"><i class="fas fa-sort-down"></i></span><span id="providers_in_buffer_up" style="display: none"><i class="fas fa-sort-up"></i></span></h4>
    		<table class="table" style="display: none" id="providers_in_buffer_table">
			  <thead>
			    <tr>
			      <th scope="col">#</th>
			      <th scope="col">Nombre</th>
			      <th scope="col">Web</th>
			      <th scope="col">Descripción</th>
			      <th scope="col">Ver</th>
			      <th scope="col">Acción</th>
			    </tr>
			  </thead>
			  <tbody>
			  	@foreach( $providersBuffered as $provider)
				    <tr id="provider-buffered-{{ $provider->provider_id }}" >
				      <th scope="row">{{ $provider->provider_id}}</th>
				      <td>{{ $provider->name}}</td>
				      <td>{{ $provider->web}}</td>
				      <td>{{ $provider->long_description}}</td>
				      <td><a target="_blank" class="btn btn-primary" href="{{ route('provider.buffered', $provider->provider()) }}">Ver proveedor</a></td>
				      <td><button class="btn btn-danger" id="approve-provider-buffered" data-id = "{{ $provider->id }}" data-url = "{{ route('approve.provider.buffered') }}" data-token = "{{ csrf_token() }}">Aprobar</button></td>
				    </tr>
			    @endforeach
			  </tbody>
			</table>
    	</div>
    </div>