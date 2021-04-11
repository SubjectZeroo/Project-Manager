<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateProjectRequest;
use App\Models\Project;
use Illuminate\Http\Request;

class ProjectsController extends Controller
{
    public function index()
    {
        $projects =  auth()->user()->projects;


        return view('projects.index', compact('projects'));
    }

    public function show(Project $project)
    {
        $this->authorize('update', $project);
        return view('projects.show', compact('project'));

    }


    public function create()
    {
        return view('projects.create');
    }

    public function store()
    {

        $attributes = $this->validateRequest();

        auth()->user()->projects()->create($attributes);

        return redirect('/projects');
    }


    public function edit(Project $project)
    {
        return view('projects.edit', compact('project'));
    }


    public function update(UpdateProjectRequest $request,Project $project)
    {

        $project->update($request->validated());

        return redirect($project->path());
    }


    protected function validateRequest()
    {

        return  request()->validate([
            'title' => 'sometimes|required',
            'description' => 'sometimes|required',
            'notes' => 'nullable'
            ]);

    }
}
