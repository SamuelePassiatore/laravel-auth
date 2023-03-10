@extends('layouts.app')

@section('title', 'Projects')

@section('content')

    <header class="my-4 d-flex justify-content-between align-items-center">
        <h1>Projects</h1>
        <div class="d-flex align-items-center">
            <form method="GET" action="{{ route('admin.projects.index') }}" class="me-5 d-flex" id="filter-form">
                <div class="input-group d-flex align-items-center">
                    <label for="search-input">Title</label>
                    <input type="text" class="form-control ms-2" placeholder="Insert a project title" name="search"
                        value="{{ $search }}" id="search-input" style="width: 50px">
                    <button class="btn btn-outline-secondary" type="submit">Search</button>
                </div>
                <div class="input-group d-flex align-items-center ms-5" style="width: 380px;">
                    <label for="filter-status">Status</label>
                    <select class="form-select ms-2" name="filter" id="filter-status">
                        <option @if ($selected === 'all') selected @endif value="">All</option>
                        <option @if ($selected === 'public') selected @endif value="public">Public</option>
                        <option @if ($selected === 'private') selected @endif value="private">Private</option>
                    </select>
                    <button class="btn btn-outline-secondary" type="submit">Filter</button>
                </div>
            </form>
            <a href="{{ route('admin.projects.create') }}" class="btn btn-success me-2">
                <i class="fas fa-plus"></i>Add project
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
                    <td>
                        <form action="{{ route('admin.projects.toggle', $project->id) }}" method="POST">
                            @method('PATCH')
                            @csrf
                            <button type="submit" class="btn btn-outline">
                                <i
                                    class="fas fa-toggle-{{ $project->is_public ? 'on' : 'off' }} {{ $project->is_public ? 'text-success' : 'text-danger' }} fa-2x"></i>
                            </button>
                        </form>
                    </td>
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
                    <td scope="row" colspan="7" class="text-center">There aren't projects in portfolio with these
                        characteristics</td>
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
    <script>
        const filterForm = document.getElementById('filter-form');
        const filterStatus = document.getElementById('filter-status');
        filterStatus.addEventListener('change', () => {
            filterForm.submit();
        })
    </script>

    {{-- <script>
        const searchInput = document.getElementById('search-input');
        searchInput.addEventListener('input', () => {
            const searchValue = searchInput.value.trim();
        });
    </script> --}}
@endsection
