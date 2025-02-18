@extends('layout')

@section('content')
<!-- the header should have a black overlay (::after)
the image should look like a typical header image, full width, not repeating -->
<header class="header-main">
    <h1 class="header-title">Freya's Garden</h1>
    <p class="header-text">catchphrase lorem ipsum dolor sit amet</p>
    <button class="btn btn-primary">Letöltés</button>
    <button class="btn btn-green">Letöltés</button>
</header>


<!-- this be should page-wide a strip, evenly spaced out -->
<!-- number should be big, the description below that and smaller -->
<div class="accomplishments-strip">
    <div>
        <span>9999999</span> km3 <br> Megtakarított Co2
    </div>
    <div>
        <span>100.000</span> <br> Regisztrált felhasználó
    </div>
    <div>
        <span>22.000</span> <br>Eladás/Csere
    </div>
    <div>
        <span>numbers</span> <br> mmmmmhmmmmm fincsi
    </div>
</div>

<main>
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
        <!-- @foreach ($articles as $article)
        <div class="card article">
            <h3>{{ $article->title }}</h3>
            <p>Növény neve</p>
            <div class="content">{!! $article->content !!}</div> <!-- Render HTML -->
    </div>
    @endforeach -->
    </div>
</main>



@endsection