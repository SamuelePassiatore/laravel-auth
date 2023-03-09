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
            'title.unique' => "Esiste già un progetto dal titolo '$request->title'",
            'title.required' => "Il titolo è obbligatorio",
            'image.url' => "L'immagine deve essere un link valido",
            'description.string' => 'La descrizione deve avere contenuto',
            'url.url' => 'L\'url deve essere un url valido',
            'url.unique' => 'L\'url deve essere unico',
        ]);

        $data = $request->all();

        $project = new Project();

        $data['slug'] = Str::slug($data['title']);

        $project->fill($data);

        // $project->slug = Str::slug($project->title, '-');

        $project->save();

        return to_route('admin.projects.show', $project->id)
            ->with('message', "Creazione progetto '$project->title' avvenuta con successo")
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
            'title.unique' => "Esiste già un progetto dal titolo '$request->title'",
            'title.required' => "Il titolo è obbligatorio",
            'image.url' => "L'immagine dev'essere un url",
            'description.string' => 'La descrizione deve essere una stringa',
            'url.url' => 'L\'url inserito non è valido',
            'url.unique' => 'L\'url deve essere unico',
        ]);

        $data = $request->all();
        $data['slug'] = Str::slug($data['title']);
        $project->update($data);

        return to_route('admin.projects.show', $project->id)
            ->with('type', 'success')
            ->with('message', "Modifica progetto '$project->title' avvenuta con successo");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        $project->delete();
        return to_route('admin.projects.index')
            ->with('message', "Eliminazione progetto '$project->title' avvenuta con successo")
            ->with('type', 'success');
    }
}
