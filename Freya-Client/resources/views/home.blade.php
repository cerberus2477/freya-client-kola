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
    <div class="content-container">
        <div>
            <h2>Rólunk (féle)</h2>
            <p>
                "Discover the wonders of greenhouse gardening with comprehensive guides and resources. From choosing the
                perfect greenhouse to designing a functional layout, Green House got you covered. Green House expert
                tips will help optimize sunlight exposure, maintain the ideal temperature, and create the perfect
                microclimate for your plants' growth."
            </p>

            <p>
                ezt loptam valahonnan és ez ad a fejemben egy konkrétabb irányt mert szerintem elég zavaros még hogy
                kiknek szól az appunk (meg így az egész persze).
                lehetne hobbikertészeknek kinda? meg ilyen plant fanatics
            </p>
            <p>
                akkor viszont mindenképp jobb lenne a weben forum féle. esetleg akkor az appban egy egy növénynél
                lehetne a csatlakozó forumokhoz linkelni. Így ez talán jobb is mintha egy-egy care guidehez linkelnénk
                ami egy full on cikk az oldalon. Ha a közösség írhat cikkeket ahogy beszéltük, akkor az már amúgy is
                majdnem forum. Annyi persze hogy egy forumnál kellenek kommentek is.
            </p>
            <p>
                a marketplace így is működik meg lehet elég közösségi dolog.
            </p>
            <p>
                a nagyobb green dologgal van igazából a gond, ezzel a várostervezős-legyen zöldebb a város történettel.
                Nem látom még mindig hogy hogyan lehetne összekötni a kettőt. Az úgy nem annyira jó hogy nehezen lehet
                elmondani két mondatban mi a projektünk.
            </p>
            <p>
                esetleg a reduce food waste lehetne, és akkor dísznövényekről és konyhakertekről is szó van kinda
            </p>
            <p>így ezek a gondolataim most</p>
        </div>


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
                <p>{{ $article['category'] }}</p>
                <p>{{ $article['plant_name'] }} ({{ $article['type'] }})</p>
            </div>
            @endforeach
            @endif
        </div>
    </div>
</main>
@endsection