
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" name="viewport" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

    <title>PuenteDE</title>

    <!--     Fonts and icons     -->
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" />
    <link rel="stylesheet" href="{{ asset('css/mk/material-kit.css') }}">
    <link rel="stylesheet" href="{{ asset('css/animate.css') }}">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">


    @yield('css')
  </head>

  <body class="landing-page ">
    <nav class="navbar navbar-color-on-scroll fixed-top navbar-transparent navbar-expand-lg " color-on-scroll="200" id="sectionsNav">
        <div class="container">
            <div class="navbar-translate">
                <a href="{{ route('welcome') }}"><img src="http://via.placeholder.com/200x150?text=logo"></a>
                <!-- <a class="navbar-brand" href="{{ route('welcome') }}">{{ config('app.name', 'AP') }}</a> -->
                <button class="navbar-toggler" type="button" data-toggle="collapse" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                    <span class="navbar-toggler-icon"></span>
                    <span class="navbar-toggler-icon"></span>
                </button>
            </div>
            @include('layouts.menu-home')
        </div>
    </nav>
    <div class="page-header header-filter" data-parallax="true" style=" background-image: url('http://via.placeholder.com/1600x800'); background-size: cover; ">
<!-- https://www.walldevil.com/wallpapers/a50/nature-wallpaper-forest-forests-bridges-bridge-background-australia-desktop.jpg -->
        <!-- <div class="container align-self-end">
            <div class="row ">
                <div class="col-md-6 text-center offset-md-3 ">
                    <h1 class="title">¿Qué es?</h1>
                    <h4>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                    tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                    quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                    consequat.</h4>
                    <br>
                    <a href="https://www.youtube.com/watch?v=eAO7CEcCD3s" target="_blank" class="btn btn-danger btn-raised btn-lg">
                        <i class="fa fa-plane"></i> Comienza el viaje
                    </a>
                </div>
            </div>
        </div> -->
        <div class="container">
            <div class="text-center">
                <h1 style="font-size: 4.5em;">El diseño
                  <span
                     class="txt-rotate"
                     data-period="2000"
                     data-rotate='[ "agrega valor", "mejora...", "esta a un click" ]'></span>
                </h1>
            </div>
        </div>
    </div>
    <div class="main main-raised">

    <section class="counter">
        <div class="counter-overlay">
            <div class="container wow bounceInLeft" data-wow-duration="1s">
                <div class="row text-center">
                    <div class="col-md-4">
                        <div class="counter-item">
                            <div><i class="fa fa-gift"></i></div>
                            <h2><span class="counter-num"> {{ $providers }} </span><span>+</span></h2>
                            <p>Empresas de diseño</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="counter-item">
                            <div><i class="fa fa-heart-o"></i></div>
                            <h2><span class="counter-num"> {{ $instances }} </span><span>+</span></h2>
                            <p>Casos de éxito</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="counter-item">
                            <div><i class="fa fa-check"></i></div>
                            <h2><span class="counter-num"> {{ $users }} </span><span>+</span></h2>
                            <p>Usuarios activos</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

        <br>
        <div class="container" id="casos">
            @yield('content')
        </div>
        <br>
    </div>
    <footer class="footer ">
        <div class="container">
            <nav class="pull-left">
                <ul>
                    <li>
                        <a href="{{ route('provider-register') }}">
                            ¿Prestas servicios de diseño? Regístrate!
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
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="{{ asset('js/scripts.js') }}"></script>
    <script src="{{ asset('js/jquery.waypoints.min.js')}}"></script>
    <script src="{{ asset('js/jquery.counterup.min.js')}}"></script>
    <script type="text/javascript">
        var TxtRotate = function(el, toRotate, period) {
  this.toRotate = toRotate;
  this.el = el;
  this.loopNum = 0;
  this.period = parseInt(period, 10) || 2000;
  this.txt = '';
  this.tick();
  this.isDeleting = false;
    };

TxtRotate.prototype.tick = function() {
  var i = this.loopNum % this.toRotate.length;
  var fullTxt = this.toRotate[i];

  if (this.isDeleting) {
    this.txt = fullTxt.substring(0, this.txt.length - 1);
  } else {
    this.txt = fullTxt.substring(0, this.txt.length + 1);
  }

  this.el.innerHTML = '<span class="wrap">'+this.txt+'</span>';

  var that = this;
  var delta = 300 - Math.random() * 100;

  if (this.isDeleting) { delta /= 2; }

  if (!this.isDeleting && this.txt === fullTxt) {
    delta = this.period;
    this.isDeleting = true;
  } else if (this.isDeleting && this.txt === '') {
    this.isDeleting = false;
    this.loopNum++;
    delta = 500;
  }

  setTimeout(function() {
    that.tick();
  }, delta);
};

window.onload = function() {
  var elements = document.getElementsByClassName('txt-rotate');
  for (var i=0; i<elements.length; i++) {
    var toRotate = elements[i].getAttribute('data-rotate');
    var period = elements[i].getAttribute('data-period');
    if (toRotate) {
      new TxtRotate(elements[i], JSON.parse(toRotate), period);
    }
  }
  // INJECT CSS
  var css = document.createElement("style");
  css.type = "text/css";
  css.innerHTML = ".txt-rotate > .wrap { border-right: 0.08em solid #FFFFFF }";
  document.body.appendChild(css);
};
    </script>


  </body>
</html>



