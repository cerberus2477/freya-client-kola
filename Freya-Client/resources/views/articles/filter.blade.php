@extends('layout')

@section('scripts')

<script src="{{ asset('js/articles.js') }}"></script>

@endsection

@section('content')

<header class="header-articles">
    <h1 class="header-title">Összes cikk</h1>
</header>

<main>
    @if(isset($errorMessage))
    <div class="error-message">
        <h2>Hiba történt</h2>
        <p>Nem sikerült elérni a szervert. Kérjük próbáld újra később</p>
        <p class="error-details">{{ $errorMessage }}</p>
    </div>
    @else
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
                    <option value="{{ $plant }}">{{ $plant }}</option>
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

        <!-- TODO -->
        <div class="pages">
            <form method="GET" action="{{ route('articles.filter') }}" id="pagination-form">
                Cikkek száma oldalanként:
                <select name="pageSize" onchange="this.form.submit()">
                    <option value="" {{ !request()->has('pageSize') ? 'selected' : '' }}>Alapértelmezett</option>
                    <option value="10" {{ request('pageSize') == 10 ? 'selected' : '' }}>10</option>
                    <option value="15" {{ request('pageSize') == 15 ? 'selected' : '' }}>15</option>
                    <option value="20" {{ request('pageSize') == 20 ? 'selected' : '' }}>20</option>
                    <option value="25" {{ request('pageSize') == 25 ? 'selected' : '' }}>25</option>
                    <option value="50" {{ request('pageSize') == 50 ? 'selected' : '' }}>50</option>
                    <!-- <option value="all" {{ request()->has('all') ? 'selected' : '' }}>Összes</option> -->
                </select>
            </form>

            @if(!request()->has('all'))
                <p>{{ $pagination["page"] }}. oldal / {{ $pagination["totalPages"] }} oldal - Cikkek száma: {{ $pagination["total"] }} </p>
                <div class="pagination-buttons">
                    @if ($pagination["page"] > 1)
                    <a href="{{ route('articles.filter', array_merge($queryParams, ['page' => $pagination["page"] - 1])) }}"
                        class="btn">
                        <i class="fa-solid fa-chevron-left"></i>
                    </a>
                    @else
                        <span class="btn disabled"><i class="fa-solid fa-chevron-left"></i></span>
                    @endif

                    @if ($pagination["page"] < $pagination["totalPages"]) 
                        <a href="{{ route('articles.filter', array_merge($queryParams, ['page' => $pagination["page"] + 1])) }}"
                        class="btn">
                            <i class="fa-solid fa-chevron-right"></i>
                        </a>
                    @else
                        <span class="btn disabled"><i class="fa-solid fa-chevron-right"></i></span>
                    @endif
                </div>
            @endif
        </div>
    </div>
    @endif
</main>
@endsection

<!-- TODO -->
<!-- - disabled button styleing
- filtereknél megmaradjon a választott (mint a pagintaionnál)
- lehet ki kell szedni a paginationt ha új filter van
- egyelőre nincs 'all' -->
