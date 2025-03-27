<!DOCTYPE html>
<html lang="hu">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', "Freya's Garden")</title>
    <link rel="shortcut icon" href="{{ asset('img/LogoTransparentBlack32x32.png') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('fontawesome/css/all.css') }}">
    @yield('styles')
    <script defer src="{{ asset('js/navbar.js') }}"></script>
    @yield('scripts')
</head>

<body>
    <nav class="main-nav" data-state="closed" data-scrolled="false">
        <div class="nav-first-row">
        <a class="nav-logo" href="{{ route('home') }}">
            <img src="{{ asset('img/LogoTransparentWhite244x244.png') }}" alt="logo">
            <h3>Freya's Garden</h3>
        </a>
            <a href="#" class="btn btn-primary navbar-toggler" onclick="toggleNav();">
                <span class="fa fa-bars"></span>
            </a>
        </div>
        <a href="{{ route('home') }}#about"> Rólunk</a>
        <a href="{{ route('home') }}#milestones"> Mérföldkövek</a>
        <a href="{{ route('articles.search') }}"> Cikkek</a>
        
    </nav>

    @yield('content')

    <footer>
        <h1>Freya's Garden</h1>
        <p>&copy; 2024.12.07 Freya-Client Tábor Tünde </p>
        <p>A projekt github oldala: <a
                href="https://github.com/stars/cerberus2477/lists/freya-s-garden" target="_blank">Freya's Garden Github</a> <a
                href="https://github.com/OOGGZZII/plamnt" target="_blank">Plamnt</a>
                
        </p>
    </footer>
</body>

</html>