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
            <th>Name</th>
            <th>Type</th>
            <th>Level Count</th>
            <th>Descripton</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($entities as $plant)
            <tr>
                <td>{{ $plant->id }}</td>
                <td>{{ $plant->name }}</td>
                <td>{{ $plant->type }}</td>
                <td>{{ $plant->levelCount }}</td>
                <td>{{ $plant->description}}</td>
                <td class="actions">
                    <a href="{{ route('games.edit', $plant->gameID) }}" class="btn btn-edit">
                        <i class="fa-solid fa-pen-to-square"></i>
                    </a>
                    <form action="{{ route('games.destroy', $plant->gameID) }}" method="POST">
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