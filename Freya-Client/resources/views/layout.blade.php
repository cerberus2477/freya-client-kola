<!DOCTYPE html>
<html lang="hu">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Freya's Garden</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('fontawesome/css/all.css') }}">
    @yield('styles')
    <script defer src="{{ asset('js/navbar.js') }}"></script>
    @yield('scripts')
</head>

<body>
    <nav class="main-nav" data-state="closed" data-scrolled="false">
        <div class="nav-first-row">
            <a class="nav-logo" href="{{route('home')}}">Freya's Garden</a>
            <a href="#" class="btn btn-primary navbar-toggler" onclick="toggleNav();">
                <span class="fa fa-bars"></span>
            </a>
        </div>
        <a href=""><i class="fa-solid fa-about-us"></i> Rólunk</a>
        <a href=""><i class="fa-solid fa-milestones"></i> Mérföldkövek</a>
        <a href="{{ route('articles.index') }}"><i class="fa-solid fa-newspaper"></i> Cikkek</a>
        <a class="btn btn-primary" href="./download.php">Letöltés</a>
    </nav>

    @yield('content')

    <footer>
        <h1>Freya's Garden</h1>
        <p>&copy; 2024.12.07 Freya-Client Tábor Tünde </p>
        <p>A projekt github oldala itt érhető el: <a
                href="https://github.com/stars/cerberus2477/lists/freya-s-garden">Freya's Garden Github</a> <a
                href="https://github.com/OOGGZZII/plamnt">Plamnt</a>
        </p>
    </footer>
</body>

</html>