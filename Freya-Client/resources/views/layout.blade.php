<!DOCTYPE html>
<html lang="hu">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Freya's Garden</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('fontawesome/css/all.css') }}">
</head>

<body>
    <nav>
        <ul>
            <li class="nav-left"><a href="{{route('home')}}"><i class="fa-solid fa-house"></i> Freya's Garden</a></li>
            <li><a href="{{ route('plants.index') }}"><i class="fa-solid fa-about-us"></i> Rólunk</a></li>
            <li><a href="{{ route('userplants.index') }}"><i class="fa-solid fa-milestones"></i> Mérföldkövek</a></li>
            <li><a href="{{ route('users.index') }}"><i class="fa-solid fa-newspaper"></i> Cikkek</a></li>
            <li><a class="btn btn-primary" href="./download.php">Letöltés</a></li>
        </ul>
    </nav>

    <main>
        @yield('content')
    </main>

    <footer>
        <p>&copy; 2024.12.07 Freya-Client Tábor Tünde </p>
        <p>A projekt github oldala itt érhető el: <a href="https://github.com/stars/cerberus2477/lists/freya-s-garden">Freya's Garden Github</a> <a href="https://github.com/OOGGZZII/plamnt">Plamnt</a>
        </p>
    </footer>
</body>

</html>