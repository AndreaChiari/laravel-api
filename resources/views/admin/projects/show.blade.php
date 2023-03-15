@extends('layouts.app')

@section('content')
    <div class="p-5 d-flex flex-column align-items-center">
        <h3>{{ $project->name }}</h3>
        <a href="{{ route('admin.projects.index', $project->id) }}" class="btn btn-small btn-primary">Back</a>
        <p>{{ $project->description }}</p>
        <a href="{{ $project->linkedin }}">check it on linkedin!</a>
        <a href="{{ $project->github }}">check it on Gitub!</a>
        <p>{{ $project->type?->name }}</p>
        {{-- <p>{{ $project->type?->name }}</p> --}}
        <img class="mt-5"src="{{ asset('storage/' . $project->image) }}" alt="{{ $project->name }}">
    </div>
@endsection
