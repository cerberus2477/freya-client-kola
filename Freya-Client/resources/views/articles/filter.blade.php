@extends('layout')

@section('content')
<header class="header-articles">
    <h1 class="header-title">Összes cikk</h1>
</header>

<main>
    <div class="filters">
        <h2>Szűrők</h2>
        <form method="GET" action="{{ route('articles.filter') }}" id="filter-form">
            <div class="category-container">
                <h3>Szűrés növény alapján</h3>
                <select name="typeofplant" id="typeofplant" class="filter-dropdown">
                    <option value="">Válassz típust</option>
                    @foreach ($types as $type)
                    <option value="{{ $type }}">{{ $type }}</option>
                    @endforeach
                </select>

                <input type="text" name="plant" id="plant" placeholder="Növény neve" list="plants">
                <datalist id="plants">
                    @foreach ($plants as $plant)
                    <option value="{{ $plant }}">
                        @endforeach
                </datalist>
            </div>

            <div class="category-container">
                <h3>Többi szűrő</h3>
                <label for="after">Dátum -tól:</label>
                <input type="date" name="after" id="after">

                <label for="before">Dátum -ig:</label>
                <input type="date" name="before" id="before">

                <label for="category">Cikk fajtája:</label>
                <select name="category">
                    <option value="">Válassz kategóriát</option>
                    @foreach ($categories as $category)
                    <option value="{{ $category }}">{{ $category }}</option>
                    @endforeach
                </select>
            </div>
        </form>
    </div>

    <div class="articles-container">
        <div class="searchbar">
            <input type="text" name="q" id="search-text" value="{{ request('q') }}" placeholder="Keresés...">
            <button type="submit" class="btn" id="search-button"><i class="fa-solid fa-search"></i></button>
        </div>

        <div class="results">
            @foreach ($articles as $article)
            <div class="card article-card">
                <p>{{$article["author"]}}</p>
                <p>{{ $article["updated_at"] }}</p>
                <h3>{{ $article["title"] }}</h3>
                <p class="article-description">{{$article["description"]}}</p>
                <p>{{ $article["category"] }}</p>
                <p>{{ $article["plant_name"] }}</p>
            </div>
            @endforeach
        </div>

        <div class="pages">
            Cikkek száma oldalanként:
            <select id="pageSize" name="pageSize">
                <option value="10">10</option>
                <option value="15">15</option>
                <option value="20">20</option>
                <option value="25">25</option>
                <option value="50">50</option>
                <option value="all">Összes</option>
            </select>
            <button type="submit" class="btn" id="prev-page"><i class="fa-solid fa-chevron-left"></i></button>
            <button type="submit" class="btn" id="next-page"><i class="fa-solid fa-chevron-right"></i></button>
        </div>
    </div>
</main>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const filterForm = document.getElementById('filter-form');
    const searchButton = document.getElementById('search-button');
    const searchText = document.getElementById('search-text');
    const filters = document.querySelectorAll('.filter-dropdown, input');

    function updateURL() {
        filterForm.submit();
    }

    searchButton.addEventListener('click', function(e) {
        e.preventDefault();
        updateURL();
    });

    filters.forEach(filter => {
        filter.addEventListener('change', updateURL);
    });
});
</script>
@endsection