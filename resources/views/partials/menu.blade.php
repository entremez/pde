<div class="menu w-100">
  <div class="menu-container">
    <div class="row">
      <div class="w-100">
        <nav class="navbar navbar-expand-lg navbar-light">
        <a class="navbar-brand" href="{{ route('welcome') }}"><img src="{{ url('/images/logo.png') }}"></a>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse flex-column" id="navbarSupportedContent">
          <ul class="navbar-nav ml-auto flex-row">  <!--ml-auto alinea a derecha-->
              @if(Auth::check())
              
                    <li class="nav-item dropdown">
                      <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="menu-name">{{ Auth::user()->email }}</span>
                      </a>
                      <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ route('home') }}">Escritorio</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item display-mobile" href="{{ route('timeline') }}">Mis viajes</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="{{ route('password.new') }}">Cambiar contraseña</a>
                        <div class="dropdown-divider"></div>
                        <a href="{{ route('logout') }}" class="dropdown-item"
                      onclick="event.preventDefault();
                      document.getElementById('logout-form').submit();">
                          Cerrar sesión
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                        </form>
                      </div>
                    </li>
              @else
              <li class="nav-item"> <!-- active para negritas -->
                <a class="nav-link btn btn-danger btn-register" data-toggle="modal" data-target="#loginModal">Registrarse o iniciar sesión</a>
              </li>
              @endif
          </ul>


          <ul class="navbar-nav ml-auto">  <!--ml-auto alinea a derecha-->
            <li class="nav-item">
              <a class="nav-link @yield('title-active')" href="{{ route('welcome') }}">Inicio</a>
            </li>
            <li class="nav-item">
              <a class="nav-link @yield('title-cases')" href="{{ route('cases') }}">Casos de diseño en los negocios</a>
            </li>
            <li class="nav-item">
              <a class="nav-link @yield('title-evaluate')" href="{{ route('evaluate') }}">Evalúa tu empresa</a>
            </li>
            <li class="nav-item">
              <a class="nav-link @yield('title-providers')" href="{{ route('providers-list') }}">Proveedores de diseño</a>
            </li>
            <li class="nav-item">
              <a class="nav-link @yield('title-resources')" href="{{ route('resources') }}">Recursos</a>
            </li>
        @if(Auth::check()) 
            @if(auth()->user()->role_id == 1)

                    <li class="nav-item dropdown">
                      <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span>Gestión</span>
                      </a>
                      <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="nav-link @yield('title-mails')" href="{{ route('mails.body') }}">Mails</a>
                        <div class="dropdown-divider"></div>
                        <a class="nav-link @yield('title-statistics')" href="{{ route('statistics') }}">Estadistica</a>
                        <div class="dropdown-divider"></div>
                        <a class="nav-link @yield('title-service-crud')" href="{{ route('service.crud') }}">Servicios</a>
                      </div>
                    </li>
            @endif
          </ul>
        @endif
        </div>
      </nav>
      </div>
    </div>
  </div>
</div>

<input type="hidden" id="errors-register" value="{{count($errors->get('email-register')) == 0 ? '':'1'}}">
<input type="hidden" id="errors-login" value="{{$errors->has('email') ? '1':''}}">

<div class="modal fade login" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="loginModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content bigModal">
      <div class="modal-body login">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <div class="col-md-12">
          <div class="row login">
            <div class="col-md-6 l-margin">
              <h3 class="text-center pb-4">Iniciar sesión</h3>

              @include('auth/login')

            </div>
            <div class="col-md-6 r-margin">
              <h3 class="text-center pb-4">Registrarse</h3>

              @include('auth/register')

            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>