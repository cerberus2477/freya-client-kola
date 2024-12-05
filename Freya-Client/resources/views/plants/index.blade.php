@extends('layout')
@section('title', 'Plants tábla')

@section('content')
    <div class="title-add">
        <h1>Plants</h1>
        <a href="{{ route('plants.create') }}" class="btn btn-add">Új rekord hozzáadása <i class="fa-solid fa-plus"></i></a>
    </div>
    @include('success')
    @include('error')
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Latin name</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($plants as $plant)
                <tr>
                    <td>{{ $plant->id }}</td>
                    <td>{{ $plant->name }}</td>
                    <td>{{ $plant->latin_name }}</td>
                    <td class="actions">
                        <a href="{{ route('plants.edit', $plant->plantID) }}" class="btn btn-edit">
                            <i class="fa-solid fa-pen-to-square"></i>
                        </a>
                        <form action="{{ route('plants.destroy', $plant->plantID) }}" method="POST">
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
