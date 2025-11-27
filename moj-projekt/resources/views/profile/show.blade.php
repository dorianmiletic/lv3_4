@extends('layouts.app')

@section('content')
<h1>Profil: {{ $user->name }}</h1>

<h2>Moji projekti (voditelj)</h2>
@foreach($owned as $project)
    <div>{{ $project->name }}</div>
@endforeach

<h2>Projekti na kojima sam član</h2>
@foreach($member as $project)
    <div>{{ $project->name }}</div>
@endforeach

<a href="{{ route('profile.edit') }}">Uredi profil</a>
@endsection
