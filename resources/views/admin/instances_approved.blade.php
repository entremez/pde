    <div class="row mt-5">
    	<div class="col">
    		<h4>Casos aprobados ({{ $instancesApproved->count() }}) <span id="instances_approved"><i class="fas fa-sort-down"></i></span><span id="instances_approved_up" style="display: none"><i class="fas fa-sort-up"></i></span></h4>
    		<table class="table" id="instances_approved_table" style="display: none">
			  <thead>
			    <tr>
			      <th scope="col">#</th>
			      <th scope="col">Nombre</th>
			      <th scope="col">Proveedor</th>
			      <th scope="col">Mandante</th>
			      <th scope="col">Descripción</th>
			      <th scope="col">Ver</th>
			    </tr>
			  </thead>
			  <tbody>
			  	@foreach( $instances as $instance)
			  		@if($instance->approved)
				    <tr>
				      <th scope="row">{{ $instance->id}}</th>
				      <td>{{ $instance->name}}</td>
				      <td>{{ $instance->provider()->first()->name}}</td>
				      <td>{{ $instance->company_name}}</td>
				      <td>{{ $instance->long_description}}</td>
				      <td><a target="_blank" class="btn btn-primary" href="{{ route('case', $instance->id) }}">Ver caso</a></td>
				    </tr>
				    @endif
			    @endforeach
			  </tbody>
			</table>
    	</div>
    </div>