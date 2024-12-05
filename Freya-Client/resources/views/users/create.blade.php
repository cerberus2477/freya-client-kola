@extends('layout')

@section('content')
    <h1>{{ isset($user) ? 'Játékos módosítása' : 'Új játékos hozzáadása' }}</h1>
    @include('error')
    <form action="{{ isset($user) ? route('users.update', $user->userID) : route('users.store') }}" method="POST">
        @csrf
        @if (isset($user))
            @method('PUT')
        @endif

        <label>Username: *</label>
        <input type="text" name="username" value="{{ $user->username ?? old('username') }}" required><br>

        <label>Password: *</label>
        <input type="password" name="password" required><br>

        <label>Email: *</label>
        <input type="email" name="email" value="{{ $user->email ?? old('email') }}" required><br>

        <label>Join Date: *</label>
        <input type="date" name="joinDate" value="{{ $user->joinDate ?? old('joinDate', date('Y-m-d')) }}" required><br>

        <label>Age:</label>
        <input type="number" name="age" value="{{ $user->age ?? '' }}"><br>

        <label>Occupation:</label>
        <input type="text" name="occupation" value="{{ $user->occupation ?? '' }}"><br>

        <label>Gender:</label>
        <input type="text" name="gender" value="{{ $user->gender ?? '' }}"><br>

        <label>City:</label>
        <input type="text" name="city" value="{{ $user->city ?? '' }}"><br>

        <button type="submit">{{ isset($user) ? 'Módosítás' : 'Mentés' }}</button>
    </form>
@endsection
