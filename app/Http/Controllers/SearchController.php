<?php

namespace App\Http\Controllers;

use App\Project;
use App\User;

class SearchController extends Controller
{
    public function user(Project $project)
    {
        $current_project_tag_ids = $project->tags()->get()->pluck('id')->toArray();
        $users = User::whereHas('tags', function ($query) use ($current_project_tag_ids) {
            $query->whereIn('tag_id', $current_project_tag_ids);
        })->get()->keyBy('id');
        $users->forget(auth()->user()->id);
        return view('search.user', compact(['users', 'project']));
    }

    public function chooseProject()
    {
        $projects = auth()->user()->projects;
        return view('search.project_overview', compact('projects'));
    }

    public function project()
    {
        $current_user = auth()->user();
        $current_user_tag_ids = $current_user->tags()->get()->pluck('id')->toArray();
        $projects = Project::whereHas('tags', function ($query) use ($current_user_tag_ids) {
            $query->whereIn('tag_id', $current_user_tag_ids);
        })->get();
        return view('search.project', compact('projects'));
    }
}
