@extends('layout')

@section('title', $article['title'])

@section('content')
    <header class="header-articles">
        <h1 class="header-title">{{ $article['title'] }}</h1>
    </header>
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
    <main>
        <div class="container main-padded article-container">
            @if (isset($errorMessage))
                <x-error-message :message="$errorMessage" />
            @else
            
                
                <div class="article-content">
                    <img src="{{ asset('img/FreyaCsopKep.jpg') }}" alt="Article Image" class="article-image">
                    <p class="article-description">
                        {{ $article['description'] }}
                    </p>
                    {{-- !! is used to safely render html --}}
                    {!! $article['content_html'] !!}
                </div>
            @endif
        </div>
    </main>
@endsection
