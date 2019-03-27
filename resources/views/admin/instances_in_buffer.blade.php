    <div class="row mt-5">
    	<div class="col">
    		<h4>Casos con cambios (<span id="number_instances_buffered">{{ $intancesBuffered->count() }}</span>)<span id="instances_buffered"><i class="fas fa-sort-down"></i></span><span id="instances_buffered_up" style="display: none"><i class="fas fa-sort-up"></i></span></h4>
    		<table class="table" id="instances_buffered_table" style="display: none">
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
			  	@foreach($intancesBuffered as $instance)
				    <tr id="instance-buffered-{{ $instance->instance_id }}" >
				      <th scope="row">{{ $instance->instance_id}}</th>
				      <td>{{ $instance->name}}</td>
				      <td>{{ $instance->providerName()}}</td>
				      <td>{{ $instance->company_name}}</td>
				      <td>{{ $instance->long_description}}</td>
				      <td><a target="_blank" class="btn btn-primary" href="{{ route('case.buffered', $instance->instance) }}">Ver caso</a></td>
				      <td><button class="btn btn-danger" id="approve-instance-buffered" data-id = "{{ $instance->id }}" data-url = "{{ route('approve.instance.buffered') }}" data-token = "{{ csrf_token() }}">Aprobar</button></td>
				    </tr>
			    @endforeach
			  </tbody>
			</table>
    	</div>
    </div>