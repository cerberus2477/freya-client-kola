@extends('layout')
@section('title', 'user tábla')

@section('content')
    <div class="title-add">
        <h1>users</h1>
        <a href="{{ route('users.create') }}" class="btn btn-add">Új rekord hozzáadása <i class="fa-solid fa-plus"></i></a>
    </div>
    @include('success')
    @include('error')
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Username</th>
                <th>Email</th>
                <th>Join Date</th>
                <th>Age</th>
                <th>Occupation</th>
                <th>Gender</th>
                <th>City</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <td>{{ $user->userID }}</td>
                    <td>{{ $user->username }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->joinDate }}</td>
                    <td>{{ $user->age }}</td>
                    <td>{{ $user->occupation }}</td>
                    <td>{{ $user->gender }}</td>
                    <td>{{ $user->city }}</td>
                    <td class="actions">
                        <a href="{{ route('users.edit', $user->userID) }}" class="btn btn-edit"><i
                                class="fa-solid fa-pen-to-square"></i></a>
                        <form action="{{ route('users.destroy', $user->userID) }}" method="POST">
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
