<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta property="og:title" content="Puente Diseño Empresa" />
    <meta property="og:description" content="El diseño mejora tu negocio" />
    <meta property="og:image" content="{{asset('images/PDE-Cuadrado.jpg')}}" />
    <meta property="og:image:width" content="900" />
    <meta property="og:image:height" content="560" />
    <meta property="og:type" content="website" />
    @yield('headers')
    <link rel="shortcut icon" href="{{ asset('pdefavicon.ico') }}" type="image/x-icon">
    <title>@yield('title', 'PuenteDE')</title>

    <link rel="stylesheet" type="text/css" href="{{ asset('styles.css') }}">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <meta name="google-site-verification" content="TyBXDeDl5VvT16szqrBx9CQgkbANsnIhDfKzhcfSYlA" />
</head>
<body>

    <div class="after-menu mobile">@include('mobile')</div>

        @yield('content')


    <script src="{{ asset('scripts.js') }}"></script>
    @yield('scripts')

</body>  
</html>