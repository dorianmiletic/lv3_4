@extends('layouts.app')

@section('content')
<h1>{{ $project->name }}</h1>
<p>{{ $project->description }}</p>
<p>Cijena: {{ $project->price }}</p>
<p>Obavljeni poslovi: {{ $project->completed_tasks }}</p>
<p>Datum početka: {{ $project->start_date }}</p>
<p>Datum završetka: {{ $project->end_date }}</p>

<h3>Članovi tima:</h3>
<ul>
    @foreach($project->members as $member)
        <li>{{ $member->name }}</li>
    @endforeach
</ul>

@if(auth()->user()->id === $project->owner_id)
    <a href="{{ route('projects.edit', $project) }}">Uredi projekt</a>
@endif
@endsection