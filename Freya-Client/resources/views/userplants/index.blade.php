@extends('layout')

@section('title', 'Player-plants')

@section('content')

    <div class="title-add">
        <h1>Player-plants</h1>
        <a href="{{ route('userplants.create') }}" class="btn btn-add">Új Player-plant rekord hozzáadása <i
                class="fa-solid fa-plus"></i></a>
    </div>
    @include('success')
    @include('error')
    <table>
        <thead>
            <tr>
                <th>Player ID</th>
                <th>Player Name</th>
                <th>plant ID</th>
                <th>plant Name</th>
                <th>plantr Tag</th>
                <th>Hours Played</th>
                <th>Last Played</th>
                <th>Join Date</th>
                <th>Current Level</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($userplants as $userplant)
                <tr>
                    <td>{{ $userplant->playerID }}</td>
                    <td>{{ $userplant->player->username }}</td> <!-- Accessing related player -->
                    <td>{{ $userplant->plantID }}</td>
                    <td>{{ $userplant->plant->name }}</td> <!-- Accessing related plant -->
                    <td>{{ $userplant->plantrTag }}</td>
                    <td>{{ $userplant->hoursPlayed }}</td>
                    <td>{{ $userplant->lastPlayedDate }}</td>
                    <td>{{ $userplant->joinDate }}</td>
                    <td>{{ $userplant->currentLevel }}</td>
                    <td class="actions">
                        <a href="{{ route('userplants.edit', [$userplant->playerID, $userplant->plantID]) }}"
                            class="btn btn-edit"><i class="fa-solid fa-pen-to-square"></i></a>
                        <form action="{{ route('userplants.destroy', [$userplant->playerID, $userplant->plantID]) }}"
                            method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-delete"><i class="fa-solid fa-trash-can"></i></button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
