<?php

namespace App\Http\Controllers\Admin;

use App\Models\Project;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $projects = Project::orderBy('updated_at', 'DESC')->paginate(5);
        return view('admin.projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $project = new Project();
        return view('admin.projects.create', compact('project'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|unique:projects',
            'image' => 'nullable|image',
            'description' => 'string',
            'url' => 'nullable|url|unique:projects',
        ], [
            'title.unique' => "The title '$request->title' has already been taken.",
        ]);

        $data = $request->all();

        $project = new Project();

        $data['slug'] = Str::slug($data['title']);

        if (Arr::exists($data, 'image')) {
            $img_url = Storage::put('projects', $data['image']);
            $data['image'] = $img_url;
        }

        $project->fill($data);

        // $project->slug = Str::slug($project->title, '-');

        $project->save();

        return to_route('admin.projects.show', $project->id)
            ->with('message', "'$project->title' project was successfully created")
            ->with('type', 'success');
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        return view('admin.projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {
        return view('admin.projects.edit', compact('project'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Project $project)
    {
        $request->validate([
            'title' => ['required', 'string', Rule::unique('projects')->ignore($project->id)],
            'image' => 'nullable|image',
            'description' => 'string',
            'url' => ['nullable', 'url', Rule::unique('projects')->ignore($project->id)],
        ], [
            'title.unique' => "The title '$request->title' has already been taken."
        ]);

        $data = $request->all();
        $data['slug'] = Str::slug($data['title']);

        if (Arr::exists($data, 'image')) {
            if ($project->image) Storage::delete($project->image);
            $img_url = Storage::put('projects', $data['image']);
            $data['image'] = $img_url;
        }

        $project->update($data);

        return to_route('admin.projects.show', $project->id)
            ->with('type', 'success')
            ->with('message', "'$project->title' project has been successfully modified");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        $project->delete();
        return to_route('admin.projects.index')
            ->with('message', "'$project->title' project has been successfully put in trashcan")
            ->with('type', 'success');
    }

    /**
     * Display a listing of the trashed resource.
     */
    public function trash()
    {
        $projects = Project::onlyTrashed()->paginate(5);
        return view('admin.projects.trash.index', compact('projects'));
    }

    /**
     * Restores a single resource from trash to active records.
     */
    public function restore(int $id)
    {
        $project = Project::onlyTrashed()->findOrFail($id);

        $project->restore();

        return to_route('admin.projects.index')->with('message', "'$project->title' has been restored.")->with('type', 'success');
    }

    /**
     * Permanently remove the specified resource from storage.
     */
    public function drop(int $id)
    {
        $project = Project::onlyTrashed()->findOrFail($id);
        if ($project->image) Storage::delete($project->image);
        $project->forceDelete();

        return to_route('admin.projects.trash.index')
            ->with('message', "'$project->title' has been deleted permanently")
            ->with('type', 'success');
    }

    public function dropAll()
    {

        $num_projects = Project::onlyTrashed()->count();


        Project::onlyTrashed()->forceDelete();


        return to_route('admin.projects.trash.index')
            ->with('message', "$num_projects projects successfully removed")
            ->with('type', 'success');
    }
}
