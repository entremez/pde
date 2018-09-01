<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" name="viewport" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

    <title>@yield('title', 'PuenteDE')</title>

    <!--     Fonts and icons     -->
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" />
    <link rel="stylesheet" href="{{ asset('css/mk/material-kit.css') }}">
    <link rel="stylesheet" href="{{ asset('css/timeline.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/timeline.css') }}">
    <link rel="stylesheet" href="{{ asset('css/simple-sidebar.css') }}">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/blank.css') }}">

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
            @if(auth()->check())
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route(auth()->user()->route_name) }}" onclick="scrollToDownload()">
                            <i class="material-icons">person</i> {{ auth()->user()->name }}
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
                            <a href="{{ route('provider.settings') }}" class="dropdown-item">
                                <i class="material-icons">settings</i> Configurar cuenta
                            </a>
                        </div>
                    </li>
                </ul>
            </div>
            @else
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav ml-auto">
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
                </ul>
            </div>
            @endif
        </div>
    </nav>

    @if(auth()->check())
    <div class="main main-raised">
        <br>
        <div class="container">
            <div id="wrapper" class="toggled">
                <!-- Sidebar -->
                <div id="sidebar-wrapper">
                    <ul class="sidebar-nav">
                        <li class="sidebar-brand">
                            <a href="#">

                            </a>
                        </li>
                        <li>
                            <a href="{{ route(auth()->user()->route_name) }}" class="@yield('dashboard')" >Inicio</a>
                        </li>

                        @if(auth()->user()->type == "Admin")
                            <li>
                                <a href="{{ route('companies') }}" class="@yield('companies')">Empresas</a>
                            </li>
                            <li>
                                <a href="{{ route('providers') }}" class="@yield('providers')">Proveedores
                                    <span class="badge badge-success" style="display: inline">{{$providers->where('approved','=','1')->count()}}</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('admin.request') }}" class="@yield('request')">Solicitudes de alta
                                    <span class="badge badge-success" style="display: inline">{{$providers->where('status','=','1')->count()}}</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('surveys.index') }}" class="@yield('survey')">Encuestas</a>
                            </li>
                            <li>
                                <a href="#">Informes</a>
                            </li>
                            <li>
                                <a href="{{ route('admin-register') }}">Agregar administrador</a>
                            </li>
                            <li>
                                <hr style="color: #FFFFFF; size: 10; border-top: 1px solid">
                            </li>
                        @elseif(auth()->user()->type == "Provider")
                            @include('provider.sidebar-provider')
                        @elseif(auth()->user()->type == "Company")
                            <li>
                                <a href="{{ route('timeline') }}" class="@yield('timeline')">Ver progreso</a>
                            </li>
                            <li>
                                <hr style="color: #FFFFFF; size: 10; border-top: 1px solid">
                            </li>
                        @endif
                    </ul>
                </div>
                <!-- /#sidebar-wrapper -->

                <!-- Page Content -->
                <br><br><br><br>
                <button class="btn btn-primary btn-fab btn-round col" id="menu-toggle">
                    <i id="menu-toggl" class="material-icons">arrow_back</i>
                </button>
                @yield('content')
            </div>
        </div>
        <br>
    </div>
    @else
        <br><br><br>
        @yield('content')
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
    @endif



    <!-- Bootstrap core JavaScript
    ================================================== -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="{{ asset('js/mk/core/jquery.min.js') }}"></script>
    <script src="{{ asset('js/mk/core/popper.min.js') }}"></script>
    <script src="{{ asset('js/mk/bootstrap-material-design.js') }}"></script>
    <!--  Plugin for Date Time Picker and Full Calendar Plugin  -->
    <script src="{{ asset('js/mk/plugins/moment.min.js') }}"></script>
    <!--    Plugin for the Datepicker, full documentation here: https://github.com/Eonasdan/bootstrap-datetimepicker -->
    <script src="{{ asset('js/mk/plugins/bootstrap-datetimepicker.min.js') }}"></script>
    <!--    Plugin for the Sliders, full documentation here: http://refreshless.com/nouislider/ -->
    <script src="{{ asset('js/mk/plugins/nouislider.min.js') }}"></script>
    <!-- Material Kit Core initialisations of plugins and Bootstrap Material Design Library -->
    <script src="{{ asset('js/mk/material-kit.js?v=2.0.2') }}"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.js"></script>
    <script src="{{ asset('js/js.js') }}"></script>
    <script type="text/javascript">
    $(document).ready( function () {
    $('#table_id').DataTable();
    } );
    $(document).ready( function () {
    $('#table_id_2').DataTable();
    } );
    $(document).ready( function () {
    $('#table_id_3').DataTable();
    } );

    </script>

  </body>
</html>



