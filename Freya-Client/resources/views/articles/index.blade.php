@extends('layout')

@section('scripts')

<script>
    document.addEventListener("DOMContentLoaded", function () {
        document.getElementById("search-button").addEventListener("click", function () {
            const searchText = document.getElementById("search-text").value;
            if (searchText.trim() !== "") {
                window.location.href = "{{ route('articles.filter') }}?q=" + encodeURIComponent(searchText);
            }
        });
    });
</script>

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
        <div class="searchbar-container">
            <input type="text" name="q" id="search-text" value="{{ request('q') }}" placeholder="Keresés...">
            <button type="button" class="btn" id="search-button"><i class="fa-solid fa-search"></i></button>
        </div>

        <div class="results">
            @foreach ($articles as $article)
            <div class="card">
                <p>{{$article["author"]}}</p>
                <p>{{ $article["updated_at"] }}</p>
                <h3>{{ $article["title"] }}</h3>
                <p class="article-description">{{$article["description"]}}</p>
                <p>{{ $article["category"] }}</p>
                <p>{{ $article["plant_name"] }} ({{ $article["type"] }})</p>
            </div>
            @endforeach
        </div>

        <!-- TODO -->
        <div class="pages">
            <form method="GET" action="{{ route('articles.index') }}" id="pagination-form">
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
                <a href="{{ route('articles.index', array_merge($queryParams, ['page' => $pagination["page"] - 1])) }}"
                    class="btn">
                    <i class="fa-solid fa-chevron-left"></i>
                </a>
                @else
                <span class="btn btn-disabled"><i class="fa-solid fa-chevron-left"></i></span>
                @endif

                @if ($pagination["page"] < $pagination["totalPages"]) <a
                    href="{{ route('articles.index', array_merge($queryParams, ['page' => $pagination["page"] + 1])) }}"
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
    @endif
</main>
@endsection