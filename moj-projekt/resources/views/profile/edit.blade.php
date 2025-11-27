@extends('layouts.app')

@section('content')
<h1>Uredi profil</h1>

<form method="POST" action="{{ route('profile.update') }}">
    @csrf
    @method('PATCH')
    
    <label for="name">Ime:</label>
    <input type="text" name="name" value="{{ $user->name }}">

    <label for="email">Email:</label>
    <input type="email" name="email" value="{{ $user->email }}">

    <button type="submit">Spremi</button>
</form>
@endsection
