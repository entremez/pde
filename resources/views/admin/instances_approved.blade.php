    <div class="row mt-5">
    	<div class="col">
    		<h4>Casos aprobados (<span id="number_instances">{{ $instancesApproved }}</span>) <span id="instances_approved"><i class="fas fa-sort-down"></i></span><span id="instances_approved_up" style="display: none"><i class="fas fa-sort-up"></i></span></h4>
    		<table class="table" id="instances_approved_table" style="display: none">
			  <thead>
			    <tr>
			      <th scope="col"></th>
			      <th scope="col">#</th>
			      <th scope="col">Nombre</th>
			      <th scope="col">Proveedor</th>
			      <th scope="col">Mandante</th>
			      <th scope="col">Descripción</th>
			      <th scope="col">Ver</th>
			    </tr>
			  </thead>
			  <tbody id="instance-approved">
			  	@foreach( $instances as $instance)
			  		@if($instance->approved and  $instance->isProviderActive())
				    <tr id="instance-approved-{{ $instance->id }}" >
				    	<th>
				    		<div class="">
				    			<i class="fas fa-heart feature heart {{ $instance->featured ? 'featured':'' }}" data-id="{{ $instance->id }}" data-url="{{ route('featured') }}" data-token="{{ csrf_token() }}"></i>
				    		</div>
				    	</th>
				      <th scope="row">{{ $instance->id}}</th>
				      <td>{{ $instance->name}}<br><a href="{{ route('admin.download', [$instance , 1]) }}" class="link-default"><i class="fas fa-image"></i></a></td>
				      <td>{{ $instance->provider()->first()->name}}<br><a href="{{ route('admin.download', [$instance , 2]) }}" class="link-default"><i class="fas fa-image"></i></a></td>
				      <td>{{ $instance->company_name}}<br><a href="{{ route('admin.download', [$instance , 3]) }}" class="link-default"><i class="fas fa-image"></i></a></td>
				      <td>{{ $instance->long_description}}</td>
				      <td><div class="d-flex">
				      	<a target="_blank" class="btn btn-primary" href="{{ route('case', $instance->id) }}">Ver caso</a>
				      	<button class="btn btn-danger ml-2" id="delete-instance" data-id = "{{ $instance->id }}" data-url = "{{ route('delete.instance') }}" data-token = "{{ csrf_token() }}">Descartar</button>
				      	</div>
				      </td>
				    </tr>
				    @endif
			    @endforeach
			  </tbody>
			</table>
    	</div>
    </div>