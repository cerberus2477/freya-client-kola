@extends('layout')

@section('title', "Freya's Garden ⸙ Főoldal")

@section('content')
<header class="header-main">
    <h1 class="header-title">Freya's Garden</h1>
    <p class="header-text">Plants 'n such</p>
    <a class="btn btn-primary" href="https://github.com/stars/cerberus2477/lists/freya-s-garden" target="_blank">GitHub</a>
</header>


<div class="accomplishments-strip" id="milestones"> 
    <div>
        <span>462</span> <br> GitHub Commit
    </div>
    <div>
        <span>151</span> <br> Lezárt github issue
    </div>
    <div>
        <span>3</span> <br> Készítő
    </div>
</div>
<main>
        <section class="main-padded" id="fresh">
            <div class="content-container">
                <h1>Friss cikkek</h1>
                <div class="articles-strip">
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
                <a class="btn" href="{{ route('articles.search') }}">
                    Többi cikk 
                    <i class="fa-solid fa-chevron-right">
                    </i>
                </a>
            </div>
        </section>



        <section class="main-padded" id="about">
            <div class="content-container">
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
                    Ez a projekt a Technikusi évünk során elkészített egész éves mestermunkánk, szakmai vizsgánk nagy része.
                </p>
            </div>
        </section>

        <section class="main-padded" id="photo">
            <div class="content-container">
                <h2>Kép a készítőkről</h2>
                <img src="{{ asset('img/FreyaCsopkep.jpg') }}" alt="">
            </div>
        </section>
</main>
@endsection