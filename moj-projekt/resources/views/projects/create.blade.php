@extends('layouts.app')

@section('content')
<h1>Dodaj novi projekt</h1>

<form method="POST" action="{{ route('projects.store') }}">
    @csrf
    <label for="name">Naziv:</label>
    <input type="text" name="name">

    <label for="description">Opis:</label>
    <textarea name="description"></textarea>

    <label for="price">Cijena:</label>
    <input type="number" name="price" step="0.01">

    <label for="start_date">Datum početka:</label>
    <input type="date" name="start_date">

    <label for="end_date">Datum završetka:</label>
    <input type="date" name="end_date">

    <button type="submit">Spremi</button>
</form>
@endsection
