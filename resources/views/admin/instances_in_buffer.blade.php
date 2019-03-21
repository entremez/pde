    <div class="row mt-5">
    	<div class="col">
    		<h4>Casos con cambios ({{ $intancesBuffered->count() }}) ESTE AUN NO!<span id="instances_buffered"><i class="fas fa-sort-down"></i></span><span id="instances_buffered_up" style="display: none"><i class="fas fa-sort-up"></i></span></h4>
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
				    <tr>
				      <th scope="row">{{ $instance->id}}</th>
				      <td>{{ $instance->name}}</td>
				      <td>{{ $instance->providerName()}}</td>
				      <td>{{ $instance->company_name}}</td>
				      <td>{{ $instance->long_description}}</td>
				      <td><a target="_blank" class="btn btn-primary" href="{{ route('case', $instance->id) }}">Ver caso</a></td>
				      <td><a class="btn btn-danger" href="{{ route('approve.instance', $instance) }}">Aprobar</a></td>
				    </tr>
			    @endforeach
			  </tbody>
			</table>
    	</div>
    </div>