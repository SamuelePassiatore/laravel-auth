{{-- Alert errori --}}

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

{{-- Form --}}
@if ($project->exists)
    <form action="{{ route('admin.projects.update', $project->id) }}" method="POST" novalidate>
        @method('PUT')
    @else
        <form action="{{ route('admin.projects.store') }}" method="POST" novalidate>
@endif


@csrf

<div class="row">
    <div class="col-4">
        <div class="mb-3">
            <label for="title" class="form-label">Titolo:</label>
            <input type="text" class="form-control" id="title" placeholder="Titolo progetto" name="title"
                required value="{{ old('title', $project->title) }}">
        </div>
    </div>
    <div class="col-4">
        <div class="mb-3">
            <label for="image" class="form-label">Immagine:</label>
            <input type="url" class="form-control" id="image" placeholder="Immagine progetto" name="image"
                value="{{ old('image', $project->image) }}">
        </div>
    </div>
    <div class="col-4">
        <div class="mb-3">
            <label for="url" class="form-label">Url:</label>
            <input type="text" class="form-control" id="url" placeholder="Url progetto" name="url"
                value="{{ old('url', $project->url) }}">
        </div>
    </div>
    <div class="col-12">
        <div class="mb-3">
            <label for="description" class="form-label">Descrizione:</label>
            <textarea name="description" id="description" rows="5" class="form-control" placeholder="Descrizione progetto">{{ old('description', $project->description) }}</textarea>
        </div>
    </div>
</div>
<hr>
<div class="d-flex justify-content-between">
    <a href="{{ route('admin.projects.index') }}" class="btn btn-secondary me-2">Torna indietro</a>
    <button type="submit" class="btn btn-primary">Salva</button>
</div>
</form>
