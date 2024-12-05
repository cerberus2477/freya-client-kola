@extends('layout')

@section('content')
    <h1>{{ isset($userplant) ? 'módosítása' : 'hozzáadása' }}</h1>
    @include('error')
    <form action="{{ isset($userplant) ? route('userplants.update', $userplant) : route('userplants.store') }}"
        method="POST">
        @csrf
        @if (isset($userplant))
            @method('PUT')
        @endif

        <!-- Player -->
        <label for="playerID">Players name: *</label>
        <select name="playerID" id="playerID" required>
            <option value="">Válassz játékost!</option>
            @foreach ($players as $player)
                <option value="{{ $player->playerID }}"
                    {{ old('playerID', $userplant->playerID ?? '') == $player->playerID ? 'selected' : '' }}>
                    {{ $player->username }} (ID: {{ $player->playerID }})
                </option>
            @endforeach
        </select><br>

        <!-- plant -->
        <label for="plantID">plant: *</label>
        <select name="plantID" id="plantID" required>
            <option value="">Válassz játékot!</option>
            @foreach ($plants as $plant)
                <option value="{{ $plant->plantID }}"
                    {{ old('plantID', $userplant->plantID ?? '') == $plant->plantID ? 'selected' : '' }}>
                    {{ $plant->name }} (ID: {{ $plant->plantID }})
                </option>
            @endforeach
        </select><br>

        <!-- plantrTag -->
        <label for="plantrTag">plantr Tag (Játékosnév játékonként): *</label>
        <input type="text" name="plantrTag" value="{{ old('plantrTag', $userplant->plantrTag ?? '') }}" required><br>

        <!-- Hours Played -->
        <label for="hoursPlayed">Hours played:</label>
        <input type="number" name="hoursPlayed" value="{{ old('hoursPlayed', $userplant->hoursPlayed ?? '') }}"><br>

        <!-- Last Played Date -->
        <label for="lastPlayedDate">Last Played Date:</label>
        <input type="date" name="lastPlayedDate"
            value="{{ old('lastPlayedDate', $userplant->lastPlayedDate ?? '') }}"><br>

        <!-- Join Date -->
        <label for="joinDate">Join Date: *</label>
        <input type="date" name="joinDate" value="{{ old('joinDate', $userplant->joinDate ?? '') }}" required><br>

        <!-- Current Level -->
        <label for="currentLevel">Current Level: </label>
        <input type="number" name="currentLevel" value="{{ old('currentLevel', $userplant->currentLevel ?? '') }}"><br>

        <button type="submit">{{ isset($userplant) ? 'Módosítás' : 'Mentés' }}</button>
    </form>
@endsection
