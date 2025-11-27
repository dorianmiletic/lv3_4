@extends('layouts.app')

@section('content')
<h1>Uredi projekt: {{ $project->name }}</h1>

<form action="{{ route('projects.update', $project->id) }}" method="POST">
    @csrf
    @method('PATCH')

    <label for="name">Naziv projekta:</label>
    <input type="text" name="name" value="{{ $project->name }}" required><br>

    <label for="description">Opis projekta:</label>
    <textarea name="description" required>{{ $project->description }}</textarea><br>

    <label for="price">Cijena projekta:</label>
    <input type="number" name="price" value="{{ $project->price }}" required><br>

    <label for="completed_tasks">Obavljeni poslovi:</label>
    <textarea name="completed_tasks">{{ $project->completed_tasks }}</textarea><br>

    <label for="start_date">Datum početka:</label>
    <input type="date" name="start_date" value="{{ $project->start_date }}"><br>

    <label for="end_date">Datum završetka:</label>
    <input type="date" name="end_date" value="{{ $project->end_date }}"><br>

    <label for="members">Članovi tima:</label>
    <select name="members[]" multiple>
        @foreach($users as $user)
            <option value="{{ $user->id }}" {{ $project->members->contains($user->id) ? 'selected' : '' }}>
                {{ $user->name }}
            </option>
        @endforeach
    </select><br>

    <button type="submit">Spremi promjene</button>
</form>
@endsection
