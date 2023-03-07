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
                </div>
            </div>

            {{-- BUTTONS --}}
            <div class="d-flex justify-content-center my-5">
                <a href="{{ route('admin.projects.index') }}" class="btn btn-warning">Back</a>
            </div>
        </div>
    </section>
@endsection

@section('scripts')

@endsection
