@extends('layout')
@section('title')
    {{ isset($plant) ? 'Játékos módosítása' : 'Új játékos hozzáadása' }}
@endsection

@section('content')
    <h1>{{ isset($user) ? 'Játékos módosítása' : 'Új játékos hozzáadása' }}</h1>
    @include('error')
    <form action="{{ isset($user) ? route('users.update', $user->userID) : route('users.store') }}" method="POST">
        @csrf
        @if (isset($user))
            @method('PUT')
        @endif

        <label>Username: *</label>
        <input type="text" name="name" value="{{ $user->name ?? old('name') }}" required><br>



        <button type="submit">{{ isset($user) ? 'Módosítás' : 'Mentés' }}</button>
    </form>
@endsection
