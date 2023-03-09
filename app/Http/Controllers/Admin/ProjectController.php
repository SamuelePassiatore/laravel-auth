<?php

namespace App\Http\Controllers\Admin;

use App\Models\Project;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $projects = Project::orderBy('updated_at', 'DESC')->get();
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
            'image' => 'nullable|url',
            'description' => 'string',
            'url' => 'nullable|url|unique:projects',
        ], [
            'title.unique' => "The title $request->titlehas already been taken."
        ]);

        $data = $request->all();

        $project = new Project();

        $data['slug'] = Str::slug($data['title']);

        $project->fill($data);

        // $project->slug = Str::slug($project->title, '-');

        $project->save();

        return to_route('admin.projects.show', $project->id)
            ->with('message', "The $project->title project was successfully created")
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
            'image' => 'nullable|url',
            'description' => 'string',
            'url' => ['nullable', 'url', Rule::unique('projects')->ignore($project->id)],
        ], [
            'title.unique' => "The title $request->titlehas already been taken."
        ]);

        $data = $request->all();
        $data['slug'] = Str::slug($data['title']);
        $project->update($data);

        return to_route('admin.projects.show', $project->id)
            ->with('type', 'success')
            ->with('message', "The $project->title project has been successfully modified");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        $project->delete();
        return to_route('admin.projects.index')
            ->with('message', "The $project->title project has been successfully deleted")
            ->with('type', 'success');
    }
}
