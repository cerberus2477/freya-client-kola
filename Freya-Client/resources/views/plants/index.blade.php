@extends('layout')
@section('title', 'Games tábla')

@section('content')
<div class="title-add">
    <h1>Games</h1>
    <a href="{{ route('games.create') }}" class="btn btn-add">Új rekord hozzáadása <i class="fa-solid fa-plus"></i></a>
</div>
@include('success')
@include('error')
<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Game Name</th>
            <th>Type</th>
            <th>Level Count</th>
            <th>Descripton</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($games as $game)
            <tr>
                <td>{{ $game->gameID }}</td>
                <td>{{ $game->name }}</td>
                <td>{{ $game->type }}</td>
                <td>{{ $game->levelCount }}</td>
                <td>{{ $game->description}}</td>
                <td class="actions">
                    <a href="{{ route('games.edit', $game->gameID) }}" class="btn btn-edit">
                        <i class="fa-solid fa-pen-to-square"></i>
                    </a>
                    <form action="{{ route('games.destroy', $game->gameID) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-delete">
                            <i class="fa-solid fa-trash-can"></i>
                        </button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
@endsection