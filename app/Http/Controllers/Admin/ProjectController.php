<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;
use Illuminate\Support\Str;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $projects = Project::all();
        return view('admin.project.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("admin.project.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //validazione dei valori della tabella richiesti
        $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
        ]);

        // da non confondere con il newProject nel seeder!!!
        $newProject = new Project();
        $newProject->title = $request->title;
        $newProject->content = $request->content;
        $newProject->slug = Str::slug($request->title);
        $newProject->save();

        return redirect()->route('admin.project.index');
    }

    /**
     * Display the specified resource.
     */

    //  funzione normale
    // public function show(Project $project)
    // {
    //     return view('admin.project.show', compact('project'));
    // }

    public function show(string $slug)
    {
        // query per recuperare il progetto
        // Project::where('slug', $slug) indica che si sta cercando un 
        // record nella tabella dei progetti (Project) dove il campo slug 
        // corrisponde al valore fornito in $slug.
        // da non confondere con il newProject nel seeder!!!
        $newProject = Project::where('slug', $slug)->first();

        // implemento il ciclo che aborta in caso non ci sia un post
        if (!$newProject) {
            abort(404);
        }

        return view('admin.project.show', compact('newProject'));
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $newProject)
    {
        $newProject->delete();

        //->with('identificativo'.'stringa'. attributo. 'stringa')
        return redirect()->route('admin.project.index')->with('success', 'project ' . $newProject->title . ' è stato eliminato con successo');
    }
}
