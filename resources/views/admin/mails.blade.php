
@extends('layouts.puente')
@section('title', 'PDE | Mails')

@section('title-mails', 'active-menu')

@section('content')

@include('partials/menu')


<div class="after-menu"></div>
<div class="col-md-10 offset-md-1 mt-5">
	<form class="contact-form" method="POST" action="{{ route('mails.store') }}" id="mail-form">
		@csrf
	    <div class="form-group mb-4">
	        <label for="new_provider" class="bmd-label-floating">Usuario creado</label>
	        <textarea type="textarea" name="new_provider" class="form-control" rows="10" id="new_provider">{{ $mail_body->new_provider }}</textarea>
	    </div>	
		<button class="btn btn-danger">Enviar</button>
	    <div class="form-group my-4">
	        <label for="provider_approved" class="bmd-label-floating">Proveedor aprobado</label>
	        <textarea type="textarea" name="provider_approved" class="form-control" rows="10" id="provider_approved">{{ $mail_body->provider_approved }}</textarea>
	    </div>	
		<button class="btn btn-danger">Enviar</button>
	    <div class="form-group my-4">
	        <label for="new_instance" class="bmd-label-floating">Caso de éxito agregado</label>
	        <textarea type="textarea" name="new_instance" class="form-control" rows="10" id="new_instance">{{ $mail_body->new_instance }}</textarea>
	    </div>	
		<button class="btn btn-danger">Enviar</button>
	    <div class="form-group my-4">
	        <label for="instance_approved" class="bmd-label-floating">Caso de éxito aprobado</label>
	        <textarea type="textarea" name="instance_approved" class="form-control" rows="10" id="instance_approved">{{ $mail_body->instance_approved }}</textarea>
	    </div>	
		<button class="btn btn-danger">Enviar</button>
	    <div class="form-group my-4">
	        <label for="user_without_profile" class="bmd-label-floating">Usuario sin perfil</label>
	        <textarea type="textarea" name="user_without_profile" class="form-control" rows="10" id="user_without_profile">{{ $mail_body->user_without_profile }}</textarea>
	    </div>	
		<button class="btn btn-danger">Enviar</button>
	</form>
</div>




@include('partials/footer')
@endsection