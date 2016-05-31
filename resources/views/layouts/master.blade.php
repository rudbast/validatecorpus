<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <title>@yield('title')</title>

    <link rel="stylesheet" type="text/css" href="{{ asset('css/app.css') }}">

    @yield('styles')
</head>
<body>
    @yield('header')

    <main class="container-fluid">
        @yield('content')
    </main>

    @yield('footer')

    <script src="{{ asset('js/app.js') }}" type="text/javascript" charset="utf-8"></script>
    @yield('scripts')
</body>
</html>
