
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>@yield('title','Puente')</title>

    <!--     Fonts and icons     -->
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" />
    <link rel="stylesheet" href="{{ asset('css/mk/material-kit.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/blank.css') }}">

    @yield('css')
  </head>

  <body class="landing-page ">
    <nav class="navbar navbar-color-on-scroll  fixed-top  navbar-expand-lg " color-on-scroll="-1" id="sectionsNav">
        <div class="container">
            <div class="navbar-translate">
                <a class="navbar-brand" href="{{ route('welcome') }}">{{ config('app.name', 'AP') }}</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                    <span class="navbar-toggler-icon"></span>
                    <span class="navbar-toggler-icon"></span>
                </button>
            </div>
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a href="{{ route('providers-list') }}" class="nav-link">
                            <i class="material-icons">list</i> Listado proveedores
                        <div class="ripple-container"></div></a>
                    </li>
                    @if(auth()->check())
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route(auth()->user()->route_name)   }}" onclick="scrollToDownload()">
                            <i class="material-icons">perm_identity</i> {{ auth()->user()->name()->name }}
                        </a>
                    </li>
                    <li class="dropdown nav-item">
                        <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
                            <i class="material-icons">menu</i> Menú
                        </a>
                        <div class="dropdown-menu dropdown-with-icons">
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
                    @else
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}" onclick="scrollToDownload()">
                            <i class="material-icons">person_outline</i> Inicia sesión
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}" onclick="scrollToDownload()">
                            <i class="material-icons">person_add</i> Regístrate
                        </a>
                    </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>
    <div class="main main-raised">
        <br>
        <div class="container">
            @yield('content')
        </div>
        <br>
    </div>
    <footer class="footer ">
        <div class="container">
            <nav class="pull-left">
                <ul>
                    <li>
                        <a href="https://www.creative-tim.com">
                            Creative Tim
                        </a>
                    </li>
                    <li>
                        <a href="http://presentation.creative-tim.com">
                            About Us
                        </a>
                    </li>
                    <li>
                        <a href="http://blog.creative-tim.com">
                            Blog
                        </a>
                    </li>
                    <li>
                        <a href="https://www.creative-tim.com/license">
                            Licenses
                        </a>
                    </li>
                </ul>
            </nav>
            <div class="copyright pull-right">
                &copy;
                <script>
                    document.write(new Date().getFullYear())
                </script>, made with <i class="material-icons">favorite</i> by
                <a href="https://www.creative-tim.com" target="_blank">Creative Tim</a> for a better web.
            </div>
        </div>
    </footer>

    <!-- Bootstrap core JavaScript
    ================================================== -->

    <script src="https://code.jquery.com/jquery-3.1.0.min.js"></script>

    <script src="{{ asset('js/scripts.js') }}"></script>
    <script src="{{ asset('js/js.js') }}"></script>


  </body>
</html>
