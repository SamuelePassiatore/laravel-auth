@extends('layouts.app')

@section('title', 'Projects')

@section('content')

    <header class="my-4">
        <h1>Projects</h1>
    </header>

    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Title</th>
                <th scope="col">Slug</th>
                <th scope="col">Url</th>
                <th scope="col"></th>
            </tr>
        </thead>
        <tbody>
            @forelse ($projects as $project)
                <tr>
                    <th scope="row">{{ $project->id }}</th>
                    <td>{{ $project->title }}</td>
                    <td>{{ $project->slug }}</td>
                    <td>{{ $project->url }}</td>
                    <td><a class="btn btn-small btn-primary" href="{{ route('admin.projects.show', $project->id) }}"><i
                                class="fa-solid fa-eye"></i></a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td scope="row" colspan="5" class="text-center">There aren't projects in portfolio</td>
                </tr>
            @endforelse


        </tbody>
    </table>

@endsection

@section('scripts')

@endsection
