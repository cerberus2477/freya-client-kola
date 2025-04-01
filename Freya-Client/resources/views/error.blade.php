@extends('layout')

@section('title', "Freya's Garden ⸙ Hiba")

@section('content')
    <header class="header-errorpage">
        <h1 class="header-title">@yield('code')</h1>
    </header>
    <main>
        <div class="container">
            <section class="errorpage main-padded">
                <img src="{{ asset('img/NotFound.png') }}" alt="" class="error-img">
                    <div class="error-message">
                        <h1 class="text-danger">@yield('code')</h1>
                        <h2> @yield('message')</h2>
                        <a class="btn btn-primary" href="{{ route('home') }}">Vissza a főoldalra</a>
                    </div>
            </section>
        </div>
    </main>
@endsection
