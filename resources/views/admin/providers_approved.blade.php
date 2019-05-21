    <div class="row mt-5">
    	<div class="col">
    		<h4>Proveedores aprobados ({{ $providersApproved->count() }}) <span id="providers_approved"><i class="fas fa-sort-down"></i></span><span id="providers_approved_up" style="display: none"><i class="fas fa-sort-up"></i></span></h4>
    		<table class="table" id="providers_approved_table" style="display: none">
			  <thead>
			    <tr>
			      <th scope="col">#</th>
			      <th scope="col">Nombre</th>
			      <th scope="col">Web</th>
			      <th scope="col">Descripción</th>
			      <th scope="col">Ver</th>
			    </tr>
			  </thead>
			  <tbody id="provider-approved">
			  	@foreach( $providers as $provider)
			  		@if($provider->approved)
				    <tr  id="provider-approved-{{ $provider->id }}">
				      <th scope="row">{{ $provider->id}}</th>
				      <td>{{ $provider->name}}</td>
				      <td>{{ $provider->web}}</td>
				      <td>{{ $provider->long_description}}</td>
				      <td>
						<div class="d-flex">
					      	<a target="_blank" class="btn btn-primary" href="{{ route('provider', $provider->id) }}">Ver proveedor</a>
					      	<button class="btn btn-danger ml-1" id="delete-provider" data-id = "{{ $provider->id }}" data-url = "{{ route('delete.provider') }}" data-token = "{{ csrf_token() }}">Descartar</button></td>
					    </div>
				    </tr>
				    @endif
			    @endforeach
			  </tbody>
			</table>
    	</div>
    </div>