    <div class="row mt-5">
    	<div class="col">
    		<h4>Proveedores con cambios ({{ $providersBuffered->count() }}) ESTE TAMPOCO!<span id="providers_in_buffer"><i class="fas fa-sort-down"></i></span></h4>
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
				    <tr>
				      <th scope="row">{{ $provider->id}}</th>
				      <td>{{ $provider->name}}</td>
				      <td>{{ $provider->web}}</td>
				      <td>{{ $provider->long_description}}</td>
				      <td><a target="_blank" class="btn btn-primary" href="{{ route('provider', $provider->id) }}">Ver proveedor</a></td>
				      <td><a class="btn btn-danger" href="{{ route('approve.provider', $provider) }}">Aprobar</a></td>
				    </tr>
			    @endforeach
			  </tbody>
			</table>
    	</div>
    </div>