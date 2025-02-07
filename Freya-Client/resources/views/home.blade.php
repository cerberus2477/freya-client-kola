@extends('layout')

@section('content')
<header>
    <h1 class="hero-title">Freya's Garden</h1>
    <p class="hero-text">catchphrase lorem ipsum dolor sit amet</p>
    <button class="btn btn-primary">Letöltés</button>
</header>
<!-- this be should page-wide a strip, evenly spaced out -->
<!-- number should be big, the description below that and smaller -->
<main>
    <div class="accomplishments-strip">
        <div>
            9999999 km3 Megtakarított Co2
        </div>
        <div>
            100.000 Regisztrált felhasználó
        </div>
        <div>
            22.000 Eladás/Csere
        </div>
        <div>
            numbers mmmmmhmmmmm fincsi
        </div>
    </div>
    <!-- this should look almost like a table, with grid lines between, above and under the cards -->
    <div class="articles-strip">
        <div>
            <h2>Friss cikkek</h2>
            <a class="btn">Többi cikk <i class="fa-solid fa-chevron-right"></i></a>
        </div>
        <div class="card">
            <h3>Cikk címe</h3>
            <p>Növény neve</p>
            <!-- idk author name, date -->
            <img>
            <a class="btn">Olvass tovább <i class="fa-solid fa-chevron-right"></i></a>
        </div>
        <div class="card">
            <h3>Cikk címe</h3>
            <p>Növény neve</p>
            <!-- idk author name, date -->
            <img>
            <a class="btn">Olvass tovább <i class="fa-solid fa-chevron-right"></i></a>
        </div>
        <div class="card">
            <h3>Cikk címe</h3>
            <p>Növény neve</p>
            <!-- idk author name, date -->
            <img>
            <a class="btn">Olvass tovább <i class="fa-solid fa-chevron-right"></i></a>
        </div>
    </div>
</main>



@endsection