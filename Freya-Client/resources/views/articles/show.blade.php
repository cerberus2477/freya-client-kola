@extends('layout')

@section('content')
    <header class="header-articles">
        <h1 class="header-title">{{ isset($article) ? $article['title'] : 'Article Not Found' }}</h1>
    </header>
    <main>
        <div class="container">
            @if (isset($errorMessage))
                <div class="error-message">
                    <h2>Hiba történt</h2>
                    <p>Nem sikerült elérni a szervert. Kérjük próbáld újra később</p>
                    <p class="error-details">{{ $errorMessage }}</p>
                </div>
            @else
                <p>
                    {{ isset($article) ? $article['description'] : 'No description available.' }}
                </p>
                <div class="content">
                    {{-- !! is used to safely render html --}}
                    {!! isset($article) ? $article['content_html'] : 'No content available.' !!}
                </div>
            @endif
        </div>
    </main>
@endsection
