@extends('layouts.app')

@section('title', 'Trash')

@section('content')

    <header class="my-4 d-flex justify-content-between align-items-center">
        <h1>Trash</h1>
        <div>
            <a href="{{ route('admin.projects.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left me-2"></i>Back</a>
        </div>
    </header>

    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Title</th>
                <th scope="col">Slug</th>
                <th scope="col">Url</th>
                <th scope="col">Update at</th>
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
                    <td>{{ $project->updated_at }}</td>
                    <td class="d-flex justify-content-end align-items-center">
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
