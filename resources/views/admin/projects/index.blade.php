@extends('layouts.app')

@section('title', 'Projects')

@section('content')

    <header class="my-4 d-flex justify-content-between align-items-center">
        <h1>Projects</h1>
        <div>
            <a href="{{ route('admin.projects.create') }}" class="btn btn-success">
                <i class="fas fa-plus me-2"></i>Add project
            </a>
            <a href="{{ route('admin.projects.trash.index') }}" class="btn btn-danger">Trash</a>
        </div>
    </header>

    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Title</th>
                <th scope="col">Slug</th>
                <th scope="col">Url</th>
                <th scope="col">Status</th>
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
                    <td>{{ $project->is_public ? 'Public' : 'Private' }}</td>
                    <td>{{ $project->updated_at }}</td>
                    <td>
                        <div class="d-flex">
                            <a class="btn btn-sm btn-primary" href="{{ route('admin.projects.show', $project->id) }}">
                                <i class="fas fa-eye"></i>
                            </a>
                            <form action="{{ route('admin.projects.destroy', $project->id) }}" method="POST"
                                class="delete-form" data-name="project">
                                @method('DELETE')
                                @csrf
                                <button type="submit" class="btn btn-sm btn-danger mx-2">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                            <a class="btn btn-sm btn-warning" href="{{ route('admin.projects.edit', $project->id) }}">
                                <i class="fas fa-pencil"></i>
                            </a>
                        </div>

                    </td>

                </tr>
            @empty
                <tr>
                    <td scope="row" colspan="7" class="text-center">There aren't projects in portfolio</td>
                </tr>
            @endforelse


        </tbody>
    </table>
    <hr>
    <div class="d-flex justify-content-end">
        @if ($projects->hasPages())
            {{ $projects->links() }}
        @endif
    </div>
@endsection

@section('scripts')

@endsection
