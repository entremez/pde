    <div class="row mt-5">
    	<div class="col">
    		<h4>Casos a aprobar ( <span id="number_instances_to_approve">{{$instancesWaitingForApproval->count() }}</span>) <span id="instances_to_approve"><i class="fas fa-sort-down"></i></span><span id="instances_to_approve_up" style="display: none"><i class="fas fa-sort-up"></i></span></h4>
    		<table class="table" id="instances_to_approve_table" style="display: none">
			  <thead>
			    <tr>
			      <th scope="col">#</th>
			      <th scope="col">Nombre</th>
			      <th scope="col">Proveedor</th>
			      <th scope="col">Mandante</th>
			      <th scope="col">Descripción</th>
			      <th scope="col">Ver</th>
			      <th scope="col">Acción</th>
			    </tr>
			  </thead>
			  <tbody>
			  	@foreach( $instances as $instance)
			  		@if(!$instance->approved)
				    <tr id="instance-{{ $instance->id }}">
				      <th scope="row">{{ $instance->id}}</th>
				      <td>{{ $instance->name}}</td>
				      <td>{{ $instance->provider()->first()->name}}</td>
				      <td>{{ $instance->company_name}}</td>
				      <td>{{ $instance->long_description}}</td>
				      <td><a target="_blank" class="btn btn-primary" href="{{ route('case', $instance->id) }}">Ver caso</a></td>
				      <td><button class="btn btn-danger" id="approve-instance" data-id = "{{ $instance->id }}" data-url = "{{ route('approve.instance') }}" data-token = "{{ csrf_token() }}">Aprobar</button></td>
				    </tr>
				    @endif
			    @endforeach
			  </tbody>
			</table>
    	</div>
    </div>