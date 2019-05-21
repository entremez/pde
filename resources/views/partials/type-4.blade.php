<form id="sort-it" class="wrap-type-4">
    <p class="stmts stmts-{{$key}}"> {{ $key+1 }}. {{ $statement->statement }}</p>
<div class="row">
	<div class="col-md-1">
	    <ol>
	    @foreach($statement->options as $key=>$option)
	      <li class="number-list-type-4">
			{{ $key+1 }}
	      </li>
	    @endforeach
	    </ol>    	
	</div>
	<div class="col-md-11">
	    <ol class="ol-type-4">
	    @foreach($statement->options as $key=>$option)
	      <li class="li-type-4">
	      	<div class="d-flex justify-content-between">
	      		<span>{{ $option->option }}</span><i class="fas fa-arrows-alt-v" style="    padding-top: .3rem;"></i>
	      	</div>
	      </li>
	    @endforeach
	    </ol>
	</div>
</div>
</form>