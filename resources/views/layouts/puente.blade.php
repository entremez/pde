<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>@yield('title', 'PuenteDE')</title>

    <link rel="stylesheet" type="text/css" href="{{ asset('styles.css') }}">
<!--     <link rel="stylesheet" href="{{ asset('css/timeline.css') }}">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons"> -->
</head>
<body>

    @yield('content')

    <script src="{{ asset('scripts.js') }}"></script>

</body>
</html>