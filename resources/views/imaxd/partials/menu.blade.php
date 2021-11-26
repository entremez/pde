<header class="header">
  <div class="header__wrapper">
    <img src="{{ asset('imaxd_assets/images/logopde 1.png') }}" alt="logo puente diseño empresa">
    <img src="{{ asset('imaxd_assets/images/logofia.png') }}" alt="logo fia">
    <nav class="header__navbar">
      <button id="js-menu-button" type="button" class="menu__button"> <img src="{{ asset('imaxd_assets/images/icons8-menu.svg') }}" alt="menu icon">  </button>
        <ul id="js-menu" class="menu">
            <li class="menu__item"><a href="/">Ir a PDE</a></li>
            <li class="menu__item"><a href="/imaxd" class="@yield('title-imaxd-home')">Inicio IMAxD</a></li>
            <li class="menu__item"><a href="/faq">Preguntas Frecuentes</a></li>
            @if(Auth::check())
              <li class="menu__item"><a href="/imaxd/dashboard">Perfil</a></li>
              <li class="menu__item"><a href="#" onclick="event.preventDefault();
                document.getElementById('logout-form').submit();">Cerrar Sesión</a></li>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                {{ csrf_field() }}
                </form>
            @else
            <div class="button-menu">
              <div id="button_login">
                <button type="button" class="menu__button login" @click="modal = true">Iniciar sesión</button>
                @include('imaxd.auth.login')
              </div>
              <div id="button_singup">
                <button type="button" class="menu__button" @click="modal = true">Inscribirse</button>
                @include('imaxd.auth.register')
              </div>
            </div>
            @endif
        </ul>
    </nav>
  </div>


</header>



