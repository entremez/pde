
@extends('layouts.puente')
@section('title', 'PDE | Dashboard Admin')

@section('content')

@include('partials/menu')
<div class="mt-5"></div>

<div class="col-md-10 offset-md-1 section">
    <h3>Hola <span>{{ auth()->user()->instance()->name }}</span>, bienvenido a tu escritorio</h3>
    <p><span class="with-comments">&nbsp;&nbsp;&nbsp;&nbsp;</span> Con comentarios de administradores <br>
      <span class="highlight">&nbsp;&nbsp;&nbsp;&nbsp;</span> Con cambios luego de enviar comentarios</p>

  @include('admin/users_without_profile')
  @include('admin/providers_to_approve')
	@include('admin/instances_to_approve')
	@include('admin/providers_in_buffer')
	@include('admin/instances_in_buffer')
	@include('admin/providers_approved')
	@include('admin/instances_approved')
  
</div>

<div class="modal fade" id="commentToProvider" tabindex="-1" role="dialog" aria-labelledby="commentToProvider" aria-hidden="true">
  <div class="modal-dialog" role="document">
  <form>
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="commentToProvider">Enviar comentarios a proveedor</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
		
      <div class="modal-body">
		  <div class="form-group">
		    <label>Para</label>
		    <input type="text" class="form-control" id="emailProvider" disabled>
		  </div>
		  <div class="form-group">
		    <label>Asunto</label>
		    <input type="text" class="form-control" value="Observaciones perfil proveedor de servicios de diseño" disabled>
		  </div>
		  <div class="form-group">
		    <label>Mensaje</label>
		    <textarea class="form-control" id="message" rows="10"></textarea>
		  </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary" id="send-comment-to-provider" data-url="{{ route('comment.provider') }}" data-token = "{{ csrf_token() }}">Enviar</button>
      </div>
    </div>
    <input type="hidden" id="idProvider">
  </form>
  </div>
</div>
@include('partials/footer')

@endsection
