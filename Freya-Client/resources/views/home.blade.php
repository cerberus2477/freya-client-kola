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