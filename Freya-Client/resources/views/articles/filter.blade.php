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
        {{-- ✅ FILTER FORM --}}
        <form method="GET" action="{{ route('articles.filter') }}" id="filter-form">
            <div class="filters">
                <h2>Szűrők</h2>

                {{-- ✅ Checkbox for deep search --}}
                <div class="category-container">
                    <span>
                        <input type="checkbox" name="deep" id="deep" {{ request('deep') ? 'checked' : '' }} onchange="document.getElementById('filter-form').submit()">
                        Keresés a cikkek szövegében is
                    </span>
                </div>

                {{-- ✅ Filter by plant type --}}
                <div class="category-container">
                    <h3>Szűrés növény alapján</h3>

                    <label for="type">Növény típusa:</label>
                    <select name="type" id="type" class="filter-dropdown" onchange="document.getElementById('filter-form').submit()">
                        <option value="">Válassz típust</option>
                        @foreach ($types as $type)
                            <option value="{{ $type }}" {{ request('type') == $type ? 'selected' : '' }}>{{ $type }}</option>
                        @endforeach
                    </select>

                    {{-- ✅ Filter by plant name (with `datalist`) --}}
                    <label for="plant">Növény neve:</label>
                    <input type="text" name="plant" id="plant" placeholder="Válassz növényt" list="plants" value="{{ request('plant') }}" onblur="document.getElementById('filter-form').submit()">
                    
                    <datalist id="plants">
                        @foreach ($plants as $plant)
                            <option value="{{ $plant }}">{{ $plant }}</option>
                        @endforeach
                    </datalist>
                </div>

                {{-- ✅ Date filters --}}
                <div class="category-container">
                    <h3>Cikk szűrő</h3>
                    <label for="after">Dátum -tól:</label>
                    <input type="date" name="after" id="after" value="{{ request('after') }}" onchange="document.getElementById('filter-form').submit()">

                    <label for="before">Dátum -ig:</label>
                    <input type="date" name="before" id="before" value="{{ request('before') }}" onchange="document.getElementById('filter-form').submit()">

                    {{-- ✅ Filter by category --}}
                    <label for="category">Cikk fajtája:</label>
                    <select name="category" id="category" class="filter-dropdown" onchange="document.getElementById('filter-form').submit()">
                        <option value="">Válassz kategóriát</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category }}" {{ request('category') == $category ? 'selected' : '' }}>
                                {{ $category }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- ✅ Reset filters (keeping search text & pageSize) --}}
                <div class="category-container">
                    <a href="{{ route('articles.filter', ['q' => request('q'), 'pageSize' => request('pageSize')]) }}">
                        <button type="button">Szűrők törlése</button>
                    </a>
                </div>
            </div>
        </form> {{-- End of Filters Form --}}

        {{-- ✅ SEARCH FORM --}}
        <div class="articles-container">
            <form method="GET" action="{{ route('articles.filter') }}">
                <div class="searchbar-container">
                    <input type="text" name="q" id="search-text" value="{{ request('q') }}" placeholder="Keresés...">
                    <button type="submit" class="btn"><i class="fa-solid fa-search"></i></button>
                </div>
            </form>

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

            {{-- ✅ PAGINATION FORM --}}
            <form method="GET" action="{{ route('articles.filter') }}">
                <div class="pages">
                    <label for="pageSize">Cikkek száma oldalanként:</label>
                    <select name="pageSize" onchange="this.form.submit()">
                        <option value="" {{ !request()->has('pageSize') ? 'selected' : '' }}>Alapértelmezett</option>
                        <option value="10" {{ request('pageSize') == 10 ? 'selected' : '' }}>10</option>
                        <option value="15" {{ request('pageSize') == 15 ? 'selected' : '' }}>15</option>
                        <option value="20" {{ request('pageSize') == 20 ? 'selected' : '' }}>20</option>
                        <option value="25" {{ request('pageSize') == 25 ? 'selected' : '' }}>25</option>
                        <option value="50" {{ request('pageSize') == 50 ? 'selected' : '' }}>50</option>
                    </select>

                    <p>{{ $pagination['page'] }}. oldal / {{ $pagination['totalPages'] }} oldal - Cikkek száma: {{ $pagination['total'] }}</p>

                    {{-- ✅ Pagination buttons --}}
                    <div class="pagination-buttons">
                        @php $query = request()->except('page'); @endphp
                        @if ($pagination['page'] > 1)
                            <a href="{{ route('articles.filter', array_merge($query, ['page' => $pagination['page'] - 1])) }}" class="btn">
                                <i class="fa-solid fa-chevron-left"></i>
                            </a>
                        @else
                            <span class="btn btn-disabled"><i class="fa-solid fa-chevron-left"></i></span>
                        @endif

                        @if ($pagination['page'] < $pagination['totalPages'])
                            <a href="{{ route('articles.filter', array_merge($query, ['page' => $pagination['page'] + 1])) }}" class="btn">
                                <i class="fa-solid fa-chevron-right"></i>
                            </a>
                        @else
                            <span class="btn btn-disabled"><i class="fa-solid fa-chevron-right"></i></span>
                        @endif
                    </div>
                </div>
            </form> {{-- End of Pagination Form --}}
        </div>
    </div>
@endif
</main>
@endsection
