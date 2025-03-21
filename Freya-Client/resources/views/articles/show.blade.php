@extends('layout')

@section('title', $article['title'])

@section('content')
    <header class="header-articles">
        <h1 class="header-title">{{ $article['title'] }}</h1>
    </header>
    <main>
        <div class="container">
            @if (isset($errorMessage))
                <x-error-message :message="$errorMessage" />
            @else
            
                <div class="article-data">
                    <p>
                        {{ $article['updated_at'] }}
                    </p>
                    <p>
                        {{ $article['author'] }}
                    </p>
                @if (isset($article['plant_name']))
                    <p>
                        {{ $article['plant_name'] }}
                    </p>
                @endif
                </div>

                <p class="article-description">
                    {{ $article['description'] }}
                </p>
                <div class="content">
                    {{-- !! is used to safely render html --}}
                    {!! $article['content_html'] !!}
                </div>
            @endif
        </div>
    </main>
@endsection
