<h2>Has ingresado el caso de éxito llamado {{ $instance->name }}</h2>
<p>El caso será revisado por los administradores previo a su publicación.
Para ver una vista previa haz click <a href="{{ route('case', $instance->id) }}">acá</a>. <small>*Para visualizar la vista previa, debes tener la sesión iniciada en el sitio.</small>
</p>

@include('mails/signature')