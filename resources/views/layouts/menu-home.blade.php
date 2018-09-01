<div class="row">
    <ul class="navbar-nav ml-auto">
        @if(auth()->check())
        <div class="col">
            <li class="dropdown nav-item">
                <a href="#" class="dropdown-toggle nav-link d-inline" data-toggle="dropdown">
                    <i class="material-icons">menu</i> {{ auth()->user()->name }}
                </a>
                <div class="dropdown-menu dropdown-with-icons">
                    <a href="{{ route($dashboard) }}" class="dropdown-item">
                        <i class="material-icons">person</i> Dashboard
                    </a>
                    <a href="{{ route('logout') }}" class="dropdown-item"
                    onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
                        <i class="material-icons">close</i> Cerrar sesión
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    {{ csrf_field() }}
                    </form>
                </div>
            </li>
        </div>
        @else
        <div class="col">
            <li class="nav-item">
                <a class="nav-link d-inline" href="{{ route('login') }}" onclick="scrollToDownload()">
                    <i class="material-icons">person_outline</i> Inicia sesión
                </a>
            </li>
        </div>
        <div class="col">
            <li class="nav-item">
                <a class="nav-link d-inline" href="{{ route('register') }}" onclick="scrollToDownload()">
                    <i class="material-icons">person_add</i> Regístrate
                </a>
            </li>
        </div>
        @endif
    </ul>
    <div class="w-100"></div>
    <ul class="navbar-nav ml-auto pt-4">
        <div class="col px-0">
            <li class="nav-item d-inline">
                <a href="#" class="nav-link">
                    <i class="material-icons">lightbulb_outline</i> ¿Qué es?
                <div class="ripple-container"></div></a>
            </li>
        </div>
        <div class="col px-0">
            <li class="nav-item d-inline">
                <a href="#casos" class="nav-link">
                    <i class="material-icons">description</i> Casos
                <div class="ripple-container"></div></a>
            </li>
        </div>
        <div class="col px-0">
            <li class="nav-item d-inline">
                <a href="{{ route('travel') }}" class="nav-link">
                    <i class="material-icons">flight_takeoff</i> Viaje PDE
                <div class="ripple-container"></div></a>
            </li>
        </div>
        <div class="col">
            <li class="nav-item d-inline">
                <a href="{{ route('providers-list') }}" class="nav-link d-inline">
                    <i class="material-icons">list</i> Proveedores
                <div class="ripple-container"></div></a>
            </li>
        </div>
        <div class="col">
            <li class="nav-item d-inline">
                <a href="#" class="nav-link d-inline">
                    <i class="material-icons">info_outline</i> Proyecto
                <div class="ripple-container"></div></a>
            </li>
        </div>
    </ul>
</div>