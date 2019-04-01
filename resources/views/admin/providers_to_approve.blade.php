    <div class="row mt-5">
    	<div class="col">
    		<h4>Proveedores a aprobar ({{ $providersWaitinfForApproval->count() }}) <span id="providers_to_approve"><i class="fas fa-sort-down"></i></span><span id="providers_to_approve_up" style="display: none"><i class="fas fa-sort-up"></i></span></h4>
    		<table class="table" style="display: none" id="providers_to_approve_table">
			  <thead>
			    <tr>
			      <th scope="col">#</th>
			      <th scope="col">Nombre</th>
			      <th scope="col">Casos ingresados</th>
			      <th scope="col">Descripción</th>
			      <th scope="col">Ver</th>
			      <th scope="col">Acción</th>
			    </tr>
			  </thead>
			  <tbody>
			  	@foreach( $providers as $provider)
			  		@if(!$provider->approved && $provider->rut != null)
				    <tr class="{{ $provider->hasComments() ? 'with-comments':'' }} {{ $provider->changesAfterComments() ? 'highlight':'' }}" id="provider-{{ $provider->id }}">
				      <th scope="row">{{ $provider->id}}</th>
				      <td>{{ $provider->name}}</td>
				      <td>{{ $provider->instances->count()}}</td>
				      <td>{{ $provider->long_description}}</td>
				      <td><a target="_blank" class="btn btn-primary" href="{{ route('provider', $provider->id) }}">Ver proveedor</a></td>
				      <td>
				      	<div class="d-flex">
					      	<button class="btn btn-danger" id="approve-provider" data-id = "{{ $provider->id }}" data-url = "{{ route('approve.provider', $provider) }}" data-token = "{{ csrf_token() }}" data-numberOfInstances="{{ $provider->instancesApproved()}}">Aprobar</button>
					      	<button id="comment-provider-{{ $provider->id }}" class="btn btn-danger ml-1 comment-to-provider" data-mail="{{ $provider->email }}" data-id="{{ $provider->id }}" data-comments = "{{ $provider->comments() }}">Enviar comentarios</button>

					    </div>
				      </td>
				    </tr>

				    @endif
			    @endforeach
			  </tbody>
			</table>
    	</div>
    </div>