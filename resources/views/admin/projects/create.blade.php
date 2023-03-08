@extends('layouts.app')

@section('title', 'Nuovo progetto')

@section('content')

    <header class="my-4 d-flex justify-content-between align-items-center">
        <h1>Nuovo progetto</h1>
    </header>
    <hr>
    <form action="{{ route('admin.projects.store') }}" method="POST">
        @csrf

        <div class="row">
            <div class="col-6">
                <div class="mb-3">
                    <label for="title" class="form-label">Titolo:</label>
                    <input type="text" class="form-control" id="title" placeholder="Titolo progetto" name="title"
                        required value="">
                </div>
            </div>
            <div class="col-6">
                <div class="mb-3">
                    <label for="image" class="form-label">Immagine:</label>
                    <input type="url" class="form-control" id="image" placeholder="Immagine progetto" name="image"
                        value="">
                </div>
            </div>
            <div class="col-6">
                <div class="mb-3">
                    <label for="slug" class="form-label">Slug:</label>
                    <input type="text" class="form-control" id="slug" placeholder="Slug" name="slug"
                        value="">
                </div>
            </div>
            <div class="col-6">
                <div class="mb-3">
                    <label for="url" class="form-label">Url:</label>
                    <input type="text" class="form-control" id="url" placeholder="Url progetto" name="url"
                        value="">
                </div>
            </div>
            <div class="col-12">
                <div class="mb-3">
                    <label for="description" class="form-label">Descrizione:</label>
                    <textarea name="description" id="description" rows="5" class="form-control" placeholder="Descrizione progetto"></textarea>
                </div>
            </div>
        </div>
        <hr>
        <div class="d-flex justify-content-between">
            <a href="{{ route('admin.projects.index') }}" class="btn btn-secondary me-2">Torna indietro</a>
            <button type="submit" class="btn btn-primary">Salva</button>
        </div>
    </form>


@endsection

@section('scripts')

@endsection
