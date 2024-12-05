@extends('layout')

@section('content')
    <h1>Játékos-Játék módosítása</h1>
    @include('error')
    {{-- <form action="{{ route('userplants.update', $userplant) }}" method="POST"> --}}
    <form action="{{ route('userplants.update', $userplant) }}" method="POST">
        @csrf
        @method('PUT')

        <!-- Player -->
        <p>Players name: {{ $player->username }} (ID: {{ $player->playerID }})</p>

        <!-- plant -->
        <p>plant: {{ $plant->name }} (ID: {{ $plant->plantID }})</p>

        <!-- Include hidden inputs for playerID and plantID -->
        <input type="hidden" name="playerID" value="{{ $userplant->playerID }}">
        <input type="hidden" name="plantID" value="{{ $userplant->plantID }}">

        <!-- plantrTag -->
        <label for="plantrTag">plantr Tag (Játékosnév játékonként): *</label>
        <input type="text" name="plantrTag" value="{{ $userplant->plantrTag }}" required><br>

        <!-- Hours Played -->
        <label for="hoursPlayed">Hours played:</label>
        <input type="number" name="hoursPlayed" value="{{ $userplant->hoursPlayed }}"><br>

        <!-- Last Played Date -->
        <label for="lastPlayedDate">Last Played Date:</label>
        <input type="date" name="lastPlayedDate" value="{{ $userplant->lastPlayedDate }}"><br>

        <!-- Join Date -->
        <label for="joinDate">Join Date: *</label>
        <input type="date" name="joinDate" value="{{ $userplant->joinDate }}" required><br>

        <!-- Current Level -->
        <label for="currentLevel">Current Level: </label>
        <input type="number" name="currentLevel" value="{{ $userplant->currentLevel }}"><br>

        <button type="submit">Módosítás</button>
    </form>
@endsection
