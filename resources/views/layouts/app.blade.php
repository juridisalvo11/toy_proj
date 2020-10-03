<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('page-title')</title>

    <script src="{{asset('js/app.js')}}" defer></script>

    <script src="https://kit.fontawesome.com/3e39139afa.js" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/handlebars@latest/dist/handlebars.js"></script>

    <link rel="stylesheet" href="{{asset('css/app.css')}}">
</head>
<body>
    <main class="py-4">
        @yield('content')
    </main>
</body>
</html>
