@extends('layout')

@section('content')

<header class="header-articles">
    <h1 class="header-title">{{ isset($article) ? $article["title"] : 'Article Not Found' }}</h1>
</header>

@if(isset($errorMessage))
<div class="error-message">
    <h2>Hiba történt</h2>
    <p>Nem sikerült elérni a szervert. Kérjük próbáld újra később</p>
    <p class="error-details">{{ $errorMessage }}</p>
</div>
@else
<main>
    <div class="container">
        <p>
            {{ isset($article) ? $article["description"] : 'No description available.' }}
        </p>
        <p>
            {{ isset($article) ? $article["content"] : 'No content available.' }}
        </p>
    </div>
</main>
@endif

@endsection