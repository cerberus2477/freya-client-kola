@extends('layout')

@section('title', "Freya's Garden ⸙ Hiba")

@section('content')
    <header class="header-errorpage">
        <h1 class="header-title">@yield('code')</h1>
    </header>
    <main>
        <div class="container">
            <section class="errorpage">
                <h1 class="text-danger">@yield('code')</h1>
                <h2> @yield('message')</h2>
                <p>Upsz! Valami probléma adódott.</p>
                <a class="btn btn-primary" href="{{ route('home') }}">Vissza a főoldalra</a>
            </section>
        </div>
    </main>
@endsection
