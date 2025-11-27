@extends('layouts.app')

@section('content')


<a href="{{ route('projects.create') }}">Novi projekt</a>
<h1>Moji projekti</h1>
@foreach($projects as $project)
    <div>
        <a href="{{ route('projects.show', $project->id) }}">{{ $project->name }}</a>
    </div>
@endforeach
@endsection
