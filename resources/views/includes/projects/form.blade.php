@if ($project->exists)
    <form action="{{ route('admin.projects.update', $project->id) }}" enctype="multipart/form-data" method="POST"
        novalidate>
        @method('PUT')
    @else
        <form action="{{ route('admin.projects.store') }}" enctype="multipart/form-data" method="POST" novalidate>
@endif
@csrf
<div class="row cols-3">
    <div class="col">
        {{-- Name project --}}
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control" id="name" name="name" placeholder="Name"
                value="{{ old('name', $project->name) }}">
        </div>
    </div>

    <div class="col">
        {{-- description project --}}
        <div class="mb-3">
            <label for="description" class="form-label">description</label>
            <input type="numeric" class="form-control" id="description" name="description" placeholder="description"
                value="{{ old('description', $project->description) }}">
        </div>
    </div>

    <div class="col">
        {{-- linkedin project  --}}
        <div class="mb-3">
            <label for="linkedin" class="form-label">linkedin</label>
            <input type="url" class="form-control" id="linkedin" name="linkedin" placeholder="linkedin"
                value="{{ old('linkedin', $project->linkedin) }}">
        </div>
    </div>

    <div class="col">
        {{-- technologies project  --}}
        @foreach ($technologies as $technology)
            <div class="mb-3">
                <input type="checkbox" class="form-check-input" id="{{ $technology->id }}" value="{{ $technology->id }}"
                    name="technologies[]" @if (in_array($technology->id, old('technologies', []))) checked @endif>
                <label class="form-check-label"
                    for="technology-{{ $technology->label }}">{{ $technology->label }}</label>
            </div>
        @endforeach
    </div>
</div>

<div class="row row-cols-1">
    <div class="col">
        {{-- created_at project --}}
        <div class="mb-3">
            <label for="github" class="form-label">github</label>
            <input type="url" class="form-control"id="github" name="github"
                value="{{ old('github', $project->github) }}" placeholder="github">
        </div>
    </div>
</div>

<div class="row row-cols-1">
    <div class="col">
        {{-- image project --}}
        <div class="mb-3">
            <label for="image" class="form-label">image</label>
            <input type="file" id="image" name="image" class="form-control">
        </div>
    </div>
</div>

<label for="type_id" class="form-label">types</label>
<select class="form-select mb-4" name="type_id" id="type_id">
    <option value="">No Types</option>
    @foreach ($types as $type)
        <option value="{{ $type->id }}">{{ $type->name }}</option>
    @endforeach
</select>



<div class="d-flex justify-content-between">
    <div>
        <a href="{{ route('admin.projects.index') }}" class="btn btn-secondary">Back</a>
    </div>
    <div class="mb-3">
        <button class="btn btn-small btn-success" type="submit">Submit</button>
    </div>
</div>
</form>
