@extends('layout')

@section('title')
    {{ isset($plant) ? 'Játék módosítása' : 'Új játék hozzáadása' }}
@endsection

@section('content')
    <h1>{{ isset($plant) ? 'Játék módosítása' : 'Új játék hozzáadása' }}</h1>
    @include('error')
    <form action="{{ isset($plant) ? route('plants.update', $plant->plantID) : route('plants.store') }}" method="POST">
        @csrf
        @if (isset($plant))
            @method('PUT')
        @endif

        <label>plant Name: *</label>
        <input type="text" name="name" value="{{ $plant->name ?? old('name') }}" required><br>

        <label>Type:</label>
        <input type="text" name="type" value="{{ $plant->type ?? old('type') }}"><br>

        <label>Level Count: *</label>
        <input type="number" name="levelCount" value="{{ $plant->levelCount ?? old('levelCount') }}" required><br>

        <label>Description:</label>
        <textarea name="description">{{ $plant->description ?? old('description') }}</textarea><br>

        <button type="submit">{{ isset($plant) ? 'Módosítás' : 'Mentés' }}</button>
    </form>
@endsection
