@extends('layouts.app')

@section('content')
    <section id="projects">
        <header>
            <h1 class="my-5">Projects:</h1>
        </header>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Name</th>
                    <th scope="col">Update At</th>
                    <th scope="col">Create At</th>
                    <th scope="col">Type</th>
                    <th scope="col">technologies</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($projects as $project)
                    <tr>
                        <th scope="row">{{ $project->id }}</th>
                        <td>{{ $project->name }}</td>
                        <td>{{ $project->updated_at }}</td>
                        <td>{{ $project->created_at }}</td>
                        <td>{{ $project->type?->name }}</td>
                        <td>
                            @forelse($project->technologies as $technology)
                                <span
                                    class="badge rounded-pill me-2 text-bg-{{ $technology->color }}">{{ $technology->label }}</span>
                            @empty
                            @endforelse
                        </td>
                        <td class="d-flex">
                            <a href="{{ route('admin.projects.show', $project->id) }}" class="btn btn-small btn-primary"><i
                                    class="fa-sharp fa-solid fa-eye"></i>See details</a>
                            <form action="{{ route('admin.projects.destroy', $project->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger ms-3">&#128465; Delete</button>
                            </form>
                            <a class="btn btn-success ms-3 button-create" href="{{ route('admin.projects.create') }}">Add
                                new
                                project</a>
                            <a href="{{ route('admin.projects.edit', $project->id) }}"
                                class="btn btn-warning ms-3">Edit</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </section>
@endsection
