@extends('layout')

@section('title', "Freya's Garden ⸙ Főoldal")

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
<div class="accomplishments-strip" id="milestones">
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
    <div class="content-container">

        <div class="articles-strip">
            <div class="card">
                <h2>Friss cikkek</h2>
                <a class="btn" href="{{ route('articles.search') }}">Többi cikk <i
                        class="fa-solid fa-chevron-right"></i></a>
            </div>
            @if (isset($errorMessage))
            <x-error-message :message="$errorMessage" />
            @else
            @foreach ($articles as $article)
            <div class="card">
                <p>{{ $article['author'] }}</p>
                <p>{{ $article['updated_at'] }}</p>
                <h3><a href="{{ route('articles.show', ['title' => $article['title']]) }}"
                        target="_blank">{{ $article['title'] }}</a>
                </h3>
                <p class="article-description">{{ $article['description'] }}</p>
                @if (isset($article['category']))
                    <p>{{ $article['category'] }}</p>
                @endif
                <p>
                @if (isset($article['plant_name']))
                    {{ $article['plant_name'] }}
                @endif
                @if (isset($article['type']))
                    ({{ $article['type'] }})
                @endif
                </p>
                
            </div>
            @endforeach
            @endif
        </div>

        <section  id="about">
            <h2>Rólunk</h2>
            <h3>Célunk</h3>
            <p>
                A Freya's Garden célja egy önfenntartó, egészséges közösség alapítása és fenntartása az otthoni kertek működéséért a városokban.
            </p>
            <p>
                Manapság nagyon sok háztartásban megoldható lenne egy konyhakert vagy akár egy kis ültetvény fenntartása. A Freya's Garden lehetővé teszi, elősegíti ezeknek működését, megjelenését, fenntartását.
            </p>
            <h3>A projekt</h3>
            <p>
                Az ötlet megfogalmazása során nagy szerepet játszott az, hogy egy valós problémát oldjunk meg.
                A környezetvédelem, és az önfenntarthatóság mind olyan témák, melyek valós problémákkal foglalkoznak, és valamennyire mindenki számára fontosok.
                Viszont mindezzel foglalkozni kimerítő reménytelen feladat lehet, főleg manapság. Ezért mi kisebb léptékben gondolkoztunk.
                Tudatos, jóindulatú közösségek megteremtésével egy nagyobb társadalmi változás első, kis lépéseinek adunk lehetőséget.
                Persze ez nem teljes megoldás, sokkal több faktor sokkal nagyobb léptékben változtatja környezetünket.
                Annyi viszont biztos, hogy a mindennapjainkban pozitív változást tud előidézni egy olyan kezdeményezés mint a mi projektünk.
            </p>
            <h3>Készítők</h3>
            <p>
                Három Boronkay-s diák vagyunk, Nacsa Levente, Szabolics András és Tábor Tünde.
                Ez a projekt a Technikusi évünk során alkészített egész éves mestermunkánk, szakmai vizsgánk nagy része.
            </p>
        </section>

    </div>
</main>
@endsection