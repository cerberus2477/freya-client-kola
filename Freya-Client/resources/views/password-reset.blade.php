@extends('layout')

@section('content')
    <header class="header-articles">
        <h1 class="header-title">Jelszó megváltoztatás</h1>
    </header>
    <main>
        <div class="container main-padded">
            @if (!session('status'))
                <form id="passwordResetForm" method="POST" action="{{ route('password.update') }}">
                    @csrf
                    <input type="hidden" name="token" value="{{ $token }}">
                    <input type="hidden" name="email" value="{{ $email }}">
                    <label for="password">Új jelszó</label>
                    <input type="password" name="password" id="password" placeholder="Új jelszó" required>
                    <label for="password_confirmation">Jelszó újra</label>
                    <input type="password" name="password_confirmation" id="password_confirmation" class="form-control"
                        placeholder="Jelszó újra" required>
                    <button type="submit" class="btn">Jelszó megváltoztatása</button>
                </form>
            @else
                <div class="alert success-message">
                    {{ session('status') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="alert error-message">
                    <h2>Jelszó változtatás sikertelen</h2>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

        </div>
    </main>
@endsection
