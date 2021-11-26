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
    <link rel="shortcut icon" href="{{ asset('pdefavicon.ico') }}" type="image/x-icon">
    <title>@yield('title', 'PuenteDE')</title>

    <link rel="stylesheet" type="text/css" href="{{ asset('imaxd_assets/css/app.min.css') }}">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <meta name="google-site-verification" content="TyBXDeDl5VvT16szqrBx9CQgkbANsnIhDfKzhcfSYlA" />
</head>
<body>

        @yield('content')

    <script src="{{ asset('imaxd_assets/vue.min.js') }}"></script>
    <script src="{{ asset('imaxd_assets/axios.js') }}"></script>
    <script src="{{ asset('imaxd_assets/imaxd.js') }}"></script>
</body>  
</html>