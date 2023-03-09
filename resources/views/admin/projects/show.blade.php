@extends('layouts.app')

@section('title', $project->title)

@section('content')

    <header class="my-4">
        <h1>{{ $project->title }}</h1>
    </header>

    <section id="single-project">
        <div class="container py-5">
            <div class="row row-cols-2 my-5">
                {{-- PROJECT IMG  --}}
                <div class="col d-flex justify-content-center py-5">
                    <img src="{{ $project->image }}" alt="{{ $project->title }}" class="rounded overflow-hidden ">
                </div>
                {{-- PROJECT CONTENT --}}
                <div class="col d-flex justify-content-center flex-column py-5">
                    <div><strong>Description: </strong>
                        <p class="my-2"> {{ $project->description }}</p>
                    </div>
                    <div class="my-2"><strong>Slug: </strong> {{ $project->slug }} </div>
                    <div class="my-2"><strong>Url: </strong> {{ $project->url }} </div>
                    <div class="my-2"><strong>Last modification: </strong> {{ $project->updated_at }} </div>
                </div>
            </div>

            {{-- BUTTONS --}}
            <div class="d-flex justify-content-center my-5">
                <a href="{{ route('admin.projects.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left me-2"></i>Back</a>
                <form action="{{ route('admin.projects.destroy', $project->id) }}" method="POST" class="delete-form"
                    data-name="project">
                    @method('DELETE')
                    @csrf
                    <button type="submit" class="btn btn-danger mx-2"><i class="fas fa-trash me-2"></i>Delete</button>
                </form>
                <a class="btn btn-warning" href="{{ route('admin.projects.edit', $project->id) }}">
                    <i class="fas fa-pencil me-2"></i>Edit
                </a>
            </div>
        </div>
    </section>
@endsection

@section('scripts')

@endsection
