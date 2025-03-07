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
                <p>
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
