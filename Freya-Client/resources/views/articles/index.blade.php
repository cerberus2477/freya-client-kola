@extends('layout')

@section('content')

<header class="header-articles">
    <h1 class="header-title">Összes cikk</h1>
</header>

<main>
    <div class="articles-container">
        <div class="searchbar">
            <input type="text" name="" id="">
            <!-- <button type="submit" class="btn">🔍</button> -->
            <a href="{{ route('articles.filter') }}" class="btn"><i class="fa-solid fa-search"></i></a>
        </div>
        <div class="results">
            <div class="card article-card">
                <p>ezaz</p>
                <p>ezaz</p>
                <h3>cimcimcimcimcim</h3>
                <p class="article-description">szovegyszovegyszovegyszovegy</p>
                <p>amaz</p>
                <p>amaz</p>
            </div>
            <div class="card article-card">
                <p>ezaz</p>
                <p>ezaz</p>
                <h3>cimcimcimcimcim</h3>
                <p class="article-description">szovegyszovegyszovegyszovegy</p>
                <p>amaz</p>
                <p>amaz</p>
            </div>
            <div class="card article-card">
                <p>ezaz</p>
                <p>ezaz</p>
                <h3>cimcimcimcimcim</h3>
                <p class="article-description">szovegyszovegyszovegyszovegy</p>
                <p>amaz</p>
                <p>amaz</p>
            </div>
            <div class="card article-card">
                <p>ezaz</p>
                <p>ezaz</p>
                <h3>cimcimcimcimcim</h3>
                <p class="article-description">szovegyszovegyszovegyszovegy</p>
                <p>amaz</p>
                <p>amaz</p>
            </div>
            <div class="card article-card">
                <p>ezaz</p>
                <p>ezaz</p>
                <h3>cimcimcimcimcim</h3>
                <p class="article-description">szovegyszovegyszovegyszovegy</p>
                <p>amaz</p>
                <p>amaz</p>
            </div>
            <div class="card article-card">
                <p>ezaz</p>
                <p>ezaz</p>
                <h3>cimcimcimcimcim</h3>
                <p class="article-description">szovegyszovegyszovegyszovegy</p>
                <p>amaz</p>
                <p>amaz</p>
            </div>
            <div class="card article-card">
                <p>ezaz</p>
                <p>ezaz</p>
                <h3>cimcimcimcimcim</h3>
                <p class="article-description">szovegyszovegyszovegyszovegy</p>
                <p>amaz</p>
                <p>amaz</p>
            </div>
            <div class="card article-card">
                <p>ezaz</p>
                <p>ezaz</p>
                <h3>cimcimcimcimcim</h3>
                <p class="article-description">szovegyszovegyszovegyszovegy</p>
                <p>amaz</p>
                <p>amaz</p>
            </div>
            <div class="card article-card">
                <p>ezaz</p>
                <p>ezaz</p>
                <h3>cimcimcimcimcim</h3>
                <p class="article-description">szovegyszovegyszovegyszovegy</p>
                <p>amaz</p>
                <p>amaz</p>
            </div>
            <div class="card article-card">
                <p>ezaz</p>
                <p>ezaz</p>
                <h3>cimcimcimcimcim</h3>
                <p class="article-description">szovegyszovegyszovegyszovegy</p>
                <p>amaz</p>
                <p>amaz</p>
            </div>
            <div class="card article-card">
                <p>ezaz</p>
                <p>ezaz</p>
                <h3>cimcimcimcimcim</h3>
                <p class="article-description">szovegyszovegyszovegyszovegy</p>
                <p>amaz</p>
                <p>amaz</p>
            </div>


        </div>
        <div class="pages">
            Cikkek száma oldalanként:
            <select>
                <option>10</option>
                <option>15</option>
                <option>20</option>
                <option>25</option>
                <option>50</option>
                <option>összes cikk</option>
            </select>
            x. oldal y-z. cikk
            <a href="{{ route('articles.index') }}" class="btn"><i class="fa-solid fa-chevron-left"></i></a>
            <a href="{{ route('articles.index') }}" class="btn"><i class="fa-solid fa-chevron-right"></i></a>
        </div>
    </div>
</main>

<script>
document.addEventListener("DOMContentLoaded", function() {
    fetch("/api/articles/search?sortby=created_at")
        .then(response => response.json())
        .then(articles => {
            const container = document.getElementById("articles-list");

            if (!articles || articles.length === 0) {
                container.innerHTML += `<p>No articles found.</p>`;
                return;
            }

            articles.forEach(article => {
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
            document.getElementById("articles-list").innerHTML += `<p>No articles found.</p>`;
        });
});
</script>
@endsection