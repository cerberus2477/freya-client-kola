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
<div>
    <p class="small-title"></p>
    <h2>Rólunk (féle)</h2>
    "Discover the wonders of greenhouse gardening with comprehensive guides and resources. From choosing the perfect greenhouse to designing a functional layout, Green House got you covered. Green House expert tips will help optimize sunlight exposure, maintain the ideal temperature, and create the perfect microclimate for your plants' growth."

ezt loptam valahonnan és ez ad a fejemben egy konkrétabb irányt mert szerintem elég zavaros még hogy kiknek szól az appunk (meg így az egész persze).
lehetne hobbikertészeknek kinda? meg ilyen plant fanatics

akkor viszont mindenképp jobb lenne a weben forum féle. esetleg akkor az appban egy egy növénynél lehetne a csatlakozó forumokhoz linkelni. Így ez talán jobb is mintha egy-egy care guidehez linkelnénk ami egy full on cikk az oldalon. Ha a közösség írhat cikkeket ahogy beszéltük, akkor az már amúgy is majdnem forum. Annyi persze hogy egy forumnál kellenek kommentek is.

a marketplace így is működik meg lehet elég közösségi dolog.

a nagyobb green dologgal van igazából a gond, ezzel a várostervezős-legyen zöldebb a város történettel. Nem látom még mindig hogy hogyan lehetne összekötni a kettőt. Az úgy nem annyira jó hogy nehezen lehet elmondani két mondatban mi a projektünk.

esetleg a reduce food waste lehetne, és akkor dísznövényekről és konyhakertekről is szó van kinda

így ezek a gondolataim most
</div>
<main>
    <!-- this should look almost like a table, with grid lines between, above and under the cards -->
    <div class="articles-strip">
        <div class="card">
            <h2>Friss cikkek</h2>
            <a class="btn" href="">Többi cikk </a>
        </div>
        <div class="card">
            <h3>Cikk címe</h3>
            <p>Növény neve</p>
            <!-- idk author name, date -->
            <img>
            <a class="btn">Olvass tovább</a>
        </div>
        <div class="card">
            <h3>Cikk címe</h3>
            <p>Növény neve</p>
            <!-- idk author name, date -->
            <img>
            <a class="btn">Olvass tovább</a>
        </div>
        <div class="card">
            <h3>Cikk címe</h3>
            <p>Növény neve</p>
            <!-- idk author name, date -->
            <img>
            <a class="btn">Olvass tovább</a>
        </div>
    </div>
</main>

<div class="articles-strip" id="articles-container">
    <div class="card">
        <h2>Friss cikkek</h2>
        <a class="btn" href="/articles">Többi cikk <i class="fa-solid fa-chevron-right"></i></a>
    </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", function() {
    fetch("/api/articles/search?sortby=created_at")
        .then(response => response.json())
        .then(articles => {
            const container = document.getElementById("articles-container");

            if (!articles || articles.length === 0) {
                container.innerHTML += `<div class="card"><p>No articles found.</p></div>`;
                return;
            }

            articles.slice(0, 3).forEach(article => {
                container.innerHTML += `
                    <div class="card">
                        <h3>${article.title}</h3>
                        <p>${article.plant_name}</p>
                        <p>By: ${article.author}</p>
                        <p>Updated: ${new Date(article.updated_at).toLocaleDateString()}</p>
                        <a class="btn" href="/article/${article.title}">Olvass tovább <i class="fa-solid fa-chevron-right"></i></a>
                    </div>
                `;
            });
        })
        .catch(error => {
            console.error("Error fetching articles:", error);
            document.getElementById("articles-container").innerHTML +=
                `<div class="card"><p>No articles found.</p></div>`;
        });
});
</script>

@endsection
