@extends('layout')

@section('title', "Freya's Garden ⸙ Keresés a cikkekben")

@section('scripts')
<script src="{{ asset('js/highlight-search-text.js') }}"></script>
@endsection

@section('content')

<header class="header-articles">
    <h1 class="header-title">Cikkek</h1>
</header>

<main>
    <!-- if there is an error, display it instead of the page contents -->
    @if (isset($errorMessage))
    <x-error-message :message="$errorMessage" />
    @else

    <form class="content-container filters-articles-container main-padded" method="GET" action="{{ route('articles.search') }}"
        id="filter-form">
        <!-- only display filters if there has been a search  - hide them initially   -->
        @if (count(request()->except(['page', 'pageSize'])) > 0)

        <button id="filter-toggle-btn" class="btn filter-toggle-btn">
            <i class="fa-solid fa-filter"></i> Szűrők
        </button>

        <div class="filters">
            <h2>Szűrők</h2>

            <div class="category-container">
                <h3>Növény alapján</h3>

                <!-- TODO: this can be a datalist too (searchable dropdown) -->
                <label for="type">Növény típusa:</label>
                <select name="type" id="type" class="filter-dropdown" onchange="this.form.submit()">
                    <option value="">Válassz típust</option>
                    @foreach ($types as $type)
                        <option value="{{ $type }}" {{ request('type') == $type ? 'selected' : '' }}>{{ $type }}
                        </option>
                    @endforeach
                </select>

                <label for="plant">Növény neve:</label>
                <input type="text" name="plant" id="plant" placeholder="Válassz növényt" list="plants"
                    value="{{ request('plant') }}" onblur="this.form.submit()">

                <datalist id="plants">
                    @foreach ($plants as $plant)
                        <option value="{{ $plant }}">{{ $plant }}</option>
                    @endforeach
                    <option value="Nincs növény">Nincs növény</option>
                </datalist>
            </div>

            <div class="category-container">
                <h3>Cikk alapján</h3>
                <label for="after">Dátum -tól:</label>
                <input type="date" name="after" id="after" value="{{ request('after') }}" onchange="this.form.submit()">

                <label for="before">Dátum -ig:</label>
                <input type="date" name="before" id="before" value="{{ request('before') }}"
                    onchange="this.form.submit()">

                <label for="category">Cikk fajtája:</label>
                <select name="category" id="category" class="filter-dropdown" onchange="this.form.submit()">
                    <option value="">Válassz kategóriát</option>
                    @foreach ($categories as $category)
                    <option value="{{ $category }}" {{ request('category') == $category ? 'selected' : '' }}>
                        {{ $category }}
                    </option>
                    @endforeach
                </select>
            </div>

            <!-- clearing the filters preserves the pagesize, q, and the deep parameter -->
            <!-- TODO: adding deep is untested, maybe it should be something like "has" with deep -->
                <a class="btn"
                    ref="{{ route('articles.search', ['q' => request('q'), 'pageSize' => request('pageSize'), 'deep' => request()->has('deep')]) }}">
                    Szűrők törlése
                </a>
        </div>
        @endif


        <div class="articles-container">
            <div class="searchbar-container">
                <div class="searchbar">
                    <input type="text" name="q" id="search-text" value="{{ request('q') }}" placeholder="Keresés...">
                    <button type="submit" class="btn"><i class="fa-solid fa-search"></i></button>
                </div>
                <span>
                    <input type="checkbox" name="deep" id="deep" {{ request()->has('deep') ? 'checked' : '' }} onchange="this.form.submit()">
                    <label for="deep">Keresés a cikkek szövegében is</label>
                </span>
            </div>

            <div class="results">
                @if (count($articles) > 0)
                    @foreach ($articles as $article)
                    <div class="card">
                        <p>{{ $article['author'] }}</p>
                        <p>{{ $article['updated_at'] }}</p>
                        <h3 class="article-title">
                            <a href="{{ route('articles.show', ['title' => $article['title']]) }}" target="_blank">
                                {{ $article['title'] }}
                            </a>
                        </h3>
                        <p class="article-description">{{ $article['description'] }}</p>
                        <p>{{ $article['category'] }}</p>
                        <p class="article-plant">{{ $article['plant_name'] }} ({{ $article['type'] }})</p>
                    </div>
                    @endforeach
                @else
                    <h2 class="no-result">Nincs találat</h2>
                @endif
            </div>

            <div class="pages">
                <div class="pageSize-selection">
                    <label for="pageSize">Cikkek száma oldalanként:</label>
                    <select name="pageSize" onchange="this.form.submit()" class="pageSize">
                        <option value="" {{ !request()->has('pageSize') ? 'selected' : '' }}>Alapértelmezett</option>
                        <option value="10" {{ request('pageSize') == 10 ? 'selected' : '' }}>10</option>
                        <option value="15" {{ request('pageSize') == 15 ? 'selected' : '' }}>15</option>
                        <option value="20" {{ request('pageSize') == 20 ? 'selected' : '' }}>20</option>
                        <option value="25" {{ request('pageSize') == 25 ? 'selected' : '' }}>25</option>
                        <option value="50" {{ request('pageSize') == 50 ? 'selected' : '' }}>50</option>
                        <option value="all" {{ request('pageSize') == 'all' ? 'selected' : '' }} >Összes</option>
                    </select>
                </div>
                

                <!-- if not all pages shown, show page selection section -->
                @if (request('pageSize') != 'all')

                    <!-- if its the first or last page, make the corresponding button disabled -->
                    <div class="pagination-buttons">
                        @php $query = request()->except('page'); @endphp
                        @if ($pagination['page'] > 1)
                            <a href="{{ route('articles.search', array_merge($query, ['page' => $pagination['page'] - 1])) }}"
                                class="btn">
                                <i class="fa-solid fa-chevron-left"></i>
                            </a>
                        @else
                            <span class="btn btn-disabled"><i class="fa-solid fa-chevron-left"></i></span>
                        @endif
                        <p>{{ $pagination['page'] }}. oldal / {{ $pagination['totalPages'] }} oldal - Cikkek száma: {{ $pagination['total'] }}</p>
                        @if ($pagination['page'] < $pagination['totalPages'])
                            <a href="{{ route('articles.search', array_merge($query, ['page' => $pagination['page'] + 1])) }}" class="btn">
                            <i class="fa-solid fa-chevron-right"></i>
                            </a>
                        @else
                            <span class="btn btn-disabled"><i class="fa-solid fa-chevron-right"></i></span>
                        @endif
                    </div>
                @endif
            </div>
        </div>
        @endif
</main>
@endsection