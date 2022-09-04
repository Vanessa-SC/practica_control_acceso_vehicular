<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link href="{{ asset('/css/style.css') }}" rel="stylesheet">
</head>

<body>
    <!-- header -->
    @include('layouts/partials/header')
    <!-- nav -->
    <div class="card">
        @yield('content')
    </div>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @yield('js')
</body>

</html>