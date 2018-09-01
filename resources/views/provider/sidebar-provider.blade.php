<li>
    <a href="{{ route('cases.index') }}" class="@yield('cases')">Administrar casos</a>
</li>
<li>
    <a href="{{ route('cases.create') }}" class="@yield('cases.create')">Agregar caso</a>
</li>
<li>
    <hr style="color: #FFFFFF; size: 10; border-top: 1px solid">
</li>
<div class="container">
    <p class="text-white">Estado: </p>
    @if($user->name()->approved == '1')
        <p class="text-white"><i class="material-icons">visibility</i> Visible</p>
    @else
        <p class="text-white"><i class="material-icons">hourglass_empty</i> En espera de aprobación</p>
    @endif
</div>