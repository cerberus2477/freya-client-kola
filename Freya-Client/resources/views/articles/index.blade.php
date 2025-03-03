@extends('layout')

@section('scripts')

<script src="{{ asset('js/articles.js') }}"></script>

@endsection
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

        </div>
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
                    <option value="all" {{ request()->has('all') ? 'selected' : '' }}>Összes</option>
                </select>
            </form>

            @if(!request()->has('all'))
                $currentPage = 2;
                <div class="pagination-buttons">
                    @if (1 > 1)
                    <a href="{{ route('articles.filter') }}"
                        class="btn">
                        <i class="fa-solid fa-chevron-left"></i>
                    </a>
                    @else
                        <span class="btn disabled"><i class="fa-solid fa-chevron-left"></i></span>
                    @endif

                    @if (1 == 1) 
                        <a href="{{ route('articles.filter') }}"
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
</main>
@endsection