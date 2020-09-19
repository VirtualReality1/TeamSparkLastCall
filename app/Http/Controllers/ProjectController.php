<?php

namespace App\Http\Controllers;

use App\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::latest()->get();
        return view('projects.index', compact('projects'));
    }

    public function create()
    {
        if (Auth::check()) {
            $tags = \App\Tag::all();
            $skills = \App\Skill::all();
            $users = \App\User::where('id', '!=', auth()->id())->get()->sortBy("username");
            return view('projects.create', compact([
                'tags',
                'skills',
                'users']));
        } else {
            return redirect('/login');
        }
    }

    public function store(Request $request)
    {
        $project = Project::create($this->validateCreateProject());
        $project->users()->attach(auth()->user(), ['role' => 'creator']);
        $project->users()->attach(request('users'), ['role' => 'invited']);
        $project->tags()->attach(request('tags'));
        $project->skills()->attach(request('skills'));

        return redirect(route('projects.index'));
    }

    public function show(Project $project)
    {
        return view('projects.show', compact('project'));
    }


    //needs a rework
    public function edit(Project $project)
    {
        $skills = \App\Skill::all();
        $tags = \App\Tag::all();
        $creator = $project->users()
            ->where('role', '=', 'creator')
            ->pluck('project_user.user_id');
        $users = \App\User::all()->except($creator[0])->sortBy("username");


        if (auth()->id() == $creator[0]) {
            return view('projects.edit', compact([
                'project',
                'tags',
                'skills',
                'users',
                'creator'
            ]));
        } else {
            return redirect($project->path());
        }
    }

    public function update(Request $request, Project $project)
    {
        $project->update($this->validateUpdateProject());
        $project->tags()->detach();
        $project->tags()->attach(request('tags'));
        $project->skills()->detach();
        $project->skills()->attach(request('skills'));
        $project->users()->wherePivot('role', '!=', 'creator')->detach();
        $project->users()->attach(request('users'));

        return redirect($project->path());
    }

    public function destroy(Project $project)
    {
        $project->delete();
    }

    //needs a rework -> FAT Models, Skinny Controllers
    public function join(Project $project)
    {
        if (Auth::guest()) {
            return redirect('/login');
        }
        if ($project->users()->where('role', '=', 'invited')->get()->contains(auth()->id())) {
            $project->users()->detach(auth()->id());
            $project->users()->attach(auth()->user(), ['role' => 'member']);
        } else {
            if ($project->users()->where('role', '=', 'interested')->get()->contains(auth()->id())) {
                $project->users()->detach(auth()->id());
            } else {
                $project->users()->attach(auth()->user(), ['role' => 'interested']);
            }
        }
        return redirect($project->path());
    }

    protected function validateCreateProject()
    {
        return request()->validate([
            'title' =>'required|string|between:3,100',
            'summary' =>'required|string|between:3,255',
            'content' =>'required|string|min:3',//Any recommendations for a max? Should be pretty big...
        ]);
    }
    protected function validateUpdateProject()
    {
        return request()->validate([
            'title' =>'required|string|between:3,100',
            'summary' =>'required|string|between:3,255',
            'content' =>'required|string|min:3',//Any recommendations for a max? Should be pretty big...
            'teamStatus' => 'required',
            'projectStatus' => 'required'
        ]);
    }
}
