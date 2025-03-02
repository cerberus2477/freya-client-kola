@extends('layout')

@section('content')
<header class="header-articles">
    <h1 class="header-title">Összes cikk</h1>
</header>
<main>
    <div class="filters">
        
        <div class="category-container">
        <h3>Cók</h3>
            <button type="submit" class="btn filter-checkbox" id="fbtn1">cucc001</button>
            <button type="submit" class="btn filter-checkbox" id="fbtn2">cucc002</button>
            <button type="submit" class="btn filter-checkbox" id="fbtn3">cucc003</button>
            <button type="submit" class="btn filter-checkbox" id="fbtn4">cucc004</button>
            <button type="submit" class="btn filter-checkbox" id="fbtn5">cucc005</button>
            <button type="submit" class="btn filter-checkbox" id="fbtn6">cucc006</button>
        </div>
        
        <div class="category-container">
        <h3>Mók</h3>
            <div class="filter-checkbox"><p>pluh</p></div>
            <div class="filter-checkbox"><p>pluhpluh</p></div>
            <div class="filter-checkbox"><p>bip</p></div>
            <div class="filter-checkbox"><p>bup</p></div>
            <div class="filter-checkbox"><p>4</p></div>
        </div>
        
        <div class="category-container">
            <h3>Kók</h3>
            <h2>Dropdown stuff</h2>
        </div>
    </div>
    <div class="articles-container">
        <div class="searchbar">
            <input type="text" name="" id="">
            <button type="submit" class="btn" >🔍</button>
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