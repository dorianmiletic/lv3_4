<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\User;
use Illuminate\Http\Request;

class ProjectController extends Controller
{   
    
    public function index()
    {
        $projects = Project::with('owner')->get();
        return view('projects.index', compact('projects'));
    }

    
    public function create()
    {
        $users = User::all();
        return view('projects.create', compact('users'));
    }

    
    public function store(Request $request)
    {   
        $request->validate([
            'name' => 'required',
            'description' => 'nullable',
            'price' => 'nullable|numeric',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date',
        ]);

        
        $project = Project::create([
            'owner_id' => auth()->id(),
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'tasks' => $request->tasks,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date
        ]);

       
        if ($request->members) {
            $project->members()->attach($request->members);
        }

        return redirect()->route('projects.index');
    }

    public function show(Project $project)
    {
        return view('projects.show', compact('project'));
    }

   
    public function edit(Project $project)
    {
        $user = auth()->user();

        
        if ($project->owner_id === $user->id) {
            return view('projects.edit-owner', [
                'project' => $project,
                'users' => User::all()
            ]);
        }

        // Član može uređivati samo tasks
        if ($project->members->contains($user->id)) {
            return view('projects.edit-member', compact('project'));
        }

        abort(403);
    }

    
    public function update(Request $request, Project $project)
    {
        $user = auth()->user();

     
        if ($project->owner_id === $user->id) {

            $project->update($request->only([
                'name', 'description', 'price', 'tasks', 'start_date', 'end_date'
            ]));

            
            if ($request->members) {
                $project->members()->sync($request->members);
            }

            return redirect()->route('projects.show', $project);
        }

       
        if ($project->members->contains($user->id)) {
            $project->update([
                'tasks' => $request->tasks
            ]);

            return redirect()->route('projects.show', $project);
        }

        abort(403);
    }

    
    public function destroy(Project $project)
    {
        if ($project->owner_id !== auth()->id()) {
            abort(403);
        }

        $project->delete();
        return redirect()->route('projects.index');
    }
}
