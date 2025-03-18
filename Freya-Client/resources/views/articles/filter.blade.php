@extends('layout')

@section('title', "Freya's Garden ⸙ Keresés a cikkekben")

@section('scripts')
<script src="{{ asset('js/highlight-search-text.js') }}"></script>
@endsection

@section('content')

<header class="header-articles">
    <h1 class="header-title">Összes cikk</h1>
</header>

<main>
    @if (isset($errorMessage))
    <x-error-message :message="$errorMessage" />
    @else

    <div class="content-container">
        <form method="GET" action="{{ route('articles.filter') }}" id="filter-form">
            <div class="filters">
                <h2>Szűrők</h2>

                <div class="category-container">
                    <h3>Szűrés növény alapján</h3>

                    <!-- TODO: this can be a datalist too (searchable dropdown) -->
                    <label for="type">Növény típusa:</label>
                    <select name="type" id="type" class="filter-dropdown"
                        onchange="document.getElementById('filter-form').submit()">
                        <option value="">Válassz típust</option>
                        @foreach ($types as $type)
                        <option value="{{ $type }}" {{ request('type') == $type ? 'selected' : '' }}>{{ $type }}
                        </option>
                        @endforeach
                    </select>

                    <label for="plant">Növény neve:</label>
                    <input type="text" name="plant" id="plant" placeholder="Válassz növényt" list="plants"
                        value="{{ request('plant') }}" onblur="document.getElementById('filter-form').submit()">

                    <datalist id="plants">
                        @foreach ($plants as $plant)
                        <option value="{{ $plant }}">{{ $plant }}</option>
                        @endforeach
                    </datalist>
                </div>

                <div class="category-container">
                    <h3>Cikk szűrő</h3>
                    <label for="after">Dátum -tól:</label>
                    <input type="date" name="after" id="after" value="{{ request('after') }}"
                        onchange="document.getElementById('filter-form').submit()">

                    <label for="before">Dátum -ig:</label>
                    <input type="date" name="before" id="before" value="{{ request('before') }}"
                        onchange="document.getElementById('filter-form').submit()">

                    <!-- TODO: this can be a datalist too (searchable dropdown) -->
                    <label for="category">Cikk fajtája:</label>
                    <select name="category" id="category" class="filter-dropdown"
                        onchange="document.getElementById('filter-form').submit()">
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
                <div class="category-container">
                    <a
                        href="{{ route('articles.filter', ['q' => request('q'), 'pageSize' => request('pageSize'), 'deep' => request()->has('deep')]) }}">
                        <button type="button">Szűrők törlése</button>
                    </a>
                </div>
            </div>


            <div class="articles-container">
                <div class="searchbar-container">
                    <input type="text" name="q" id="search-text" value="{{ request('q') }}" placeholder="Keresés...">
                    <span>
                        <input type="checkbox" name="deep" id="deep" {{ request('deep') ? 'checked' : '' }}
                            onchange="document.getElementById('filter-form').submit()">
                        Keresés a cikkek szövegében is
                    </span>
                    <button type="submit" class="btn"><i class="fa-solid fa-search"></i></button>
                </div>

                <div class="results">
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
                </div>

                <div class="pages">
                    <label for="pageSize">Cikkek száma oldalanként:</label>
                    <select name="pageSize" onchange="this.form.submit()">
                        <option value="" {{ !request()->has('pageSize') ? 'selected' : '' }}>Alapértelmezett
                        </option>
                        <option value="10" {{ request('pageSize') == 10 ? 'selected' : '' }}>10</option>
                        <option value="15" {{ request('pageSize') == 15 ? 'selected' : '' }}>15</option>
                        <option value="20" {{ request('pageSize') == 20 ? 'selected' : '' }}>20</option>
                        <option value="25" {{ request('pageSize') == 25 ? 'selected' : '' }}>25</option>
                        <option value="50" {{ request('pageSize') == 50 ? 'selected' : '' }}>50</option>
                        <!-- <option value="all" {{ request()->has('all') ? 'selected' : '' }}>Összes</option> -->

                    </select>

                    <!-- if not all pages all shown, show page selection section -->
                    @if (!request()->has('all'))

                    <p>{{ $pagination['page'] }}. oldal / {{ $pagination['totalPages'] }} oldal - Cikkek száma:
                        {{ $pagination['total'] }}</p>

                    <!-- if its the first or last page, make the corresponding button disabled -->
                    <div class="pagination-buttons">
                        @php $query = request()->except('page'); @endphp
                        @if ($pagination['page'] > 1)
                        <a href="{{ route('articles.filter', array_merge($query, ['page' => $pagination['page'] - 1])) }}"
                            class="btn">
                            <i class="fa-solid fa-chevron-left"></i>
                        </a>
                        @else
                        <span class="btn btn-disabled"><i class="fa-solid fa-chevron-left"></i></span>
                        @endif

                        @if ($pagination['page'] < $pagination['totalPages']) <a
                            href="{{ route('articles.filter', array_merge($query, ['page' => $pagination['page'] + 1])) }}"
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
        </form>
    </div>
    @endif
</main>
@endsection