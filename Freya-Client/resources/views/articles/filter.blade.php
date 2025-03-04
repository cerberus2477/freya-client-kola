@extends('layout')

@section('scripts')

<script src="{{ asset('js/articles.js') }}"></script>

@endsection

@section('content')

<header class="header-articles">
    <h1 class="header-title">Összes cikk</h1>
</header>

@if(isset($errorMessage))
<div class="error-message">
    <h2>Hiba történt</h2>
    <p>Nem sikerült elérni a szervert. Kérjük próbáld újra később</p>
    <p class="error-details">{{ $errorMessage }}</p>
</div>
@else
<main>
    <div class="content-container">
        <div class="filters">
            <h2>Szűrők</h2>
            <form method="GET" action="{{ route('articles.filter') }}" id="filter-form">
                <div class="category-container">
                    <span><input type="checkbox" name="deep" id="deep" {{ request('deep') ? 'checked' : '' }}>
                        Keresés a cikkek szövegében is</span>
                </div>
                <div class="category-container">
                    <h3>Szűrés növény alapján</h3>
                    <select name="type" id="type" class="filter-dropdown">
                        <option value="">Válassz típust</option>
                        @foreach ($types as $type)
                        <option value="{{ $type }}" {{ request('type') == $type ? 'selected' : '' }}>{{ $type }}
                        </option>
                        @endforeach
                    </select>

                    <input type="text" name="plant" id="plant" placeholder="Növény neve" list="plants"
                        value="{{ request('plant') }}">
                    <datalist name="plants" id="plants" class="filter-dropdown">
                        @foreach ($plants as $plant)
                        <option value="{{ $plant }}" {{ request('plant') == $plant ? 'selected' : '' }}>{{ $plant }}
                        </option>
                        @endforeach
                    </datalist>
                </div>

                <div class="category-container">
                    <h3>Többi szűrő</h3>
                    <label for="after">Dátum -tól:</label>
                    <input type="date" name="after" id="after" value="{{ request('after') }}">

                    <label for="before">Dátum -ig:</label>
                    <input type="date" name="before" id="before" value="{{ request('before') }}">

                    <label for="category">Cikk fajtája:</label>
                    <select name="category" id="category" class="filter-dropdown">
                        <option value="">Válassz kategóriát</option>
                        @foreach ($categories as $category)
                        <option value="{{ $category }}" {{ request('category') == $category ? 'selected' : '' }}>
                            {{ $category }}</option>
                        @endforeach
                    </select>

                </div>

                <div class="category-container">
                    <input type="button" value="Szűrők törlése" id="clear-filters">
                </div>

            </form>
        </div>

        <div class="articles-container">
            <div class="searchbar-container">
                <input type="text" name="q" id="search-text" value="{{ request('q') }}" placeholder="Keresés...">
                <button type="submit" class="btn" id="search-button"><i class="fa-solid fa-search"></i></button>
            </div>


            <div class="results">
                @foreach ($articles as $article)
                <div class="card">
                    <p>{{$article["author"]}}</p>
                    <p>{{ $article["updated_at"] }}</p>
                    <h3><a href="{{ route('articles.show', ['title' => $article['title']]) }}"
                            target="_blank">{{ $article["title"] }}</a>
                    </h3>
                    <p class="article-description">{{$article["description"]}}</p>
                    <p>{{ $article["category"] }}</p>
                    <p>{{ $article["plant_name"] }} ({{ $article["type"] }})</p>
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


                <!-- if not all pages all shown, show page selection section -->
                @if(!request()->has('all'))
                <p>{{ $pagination["page"] }}. oldal / {{ $pagination["totalPages"] }} oldal - Cikkek száma:
                    {{ $pagination["total"] }} </p>
                <div class="pagination-buttons">
                    <!-- if its the first or last page, make the corresponding button disabled -->
                    @if ($pagination["page"] > 1)
                    <a href="{{ route('articles.filter', array_merge($queryParams, ['page' => $pagination["page"] - 1])) }}"
                        class="btn">
                        <i class="fa-solid fa-chevron-left"></i>
                    </a>
                    @else
                    <span class="btn btn-disabled"><i class="fa-solid fa-chevron-left"></i></span>
                    @endif

                    @if ($pagination["page"] < $pagination["totalPages"]) <a
                        href="{{ route('articles.filter', array_merge($queryParams, ['page' => $pagination["page"] + 1])) }}"
                        class="btn">
                        <i class="fa-solid fa-chevron-right"></i>
                        </a>
                        @else
                        <span class="btn btn-disabled"><i class="fa-solid fa-chevron-right"></i></span>
                        @endif
                </div>
                @endif
            </div>
        </div>
    </div>
    @endif
</main>
@endsection

<!-- TODO -->
<!-- - add disabled button styleing
- filtereknél megmaradjon a választott (mint a pagintaionnál)
- lehet ki kell szedni a paginationt ha új filter van
- egyelőre nincs 'all' -->