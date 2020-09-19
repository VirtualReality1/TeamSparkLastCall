<?php


namespace App\Http\Controllers;

use App\Http\Requests\AvatarRequest;
use App\Http\Requests\ProfileUpdateRequest;
use App\Project;
use App\User;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class ProfileController extends Controller
{
    public function index()
    {
        $users = User::latest()->get();
        return view('profiles.index', compact('users'));
    }


    public function show(User $user)
    {
        return view('profiles.show', compact('user'));
    }


    public function edit()
    {
        $tags = \App\Tag::all();
        $skills = \App\Skill::all();
        $user = Auth::user();
        return view('profiles.edit', compact(['user', 'tags', 'skills']));
    }

    public function update(ProfileUpdateRequest $request)
    {
        $user = Auth::user();
        $request->merge(['showMail' => array_key_exists('showMail', $request->validated())]);
        $user->tags()->sync(request('tags'));
        $user->skills()->sync(request('skills'));
        $user->fill($request->all());
        $user->save();
        return redirect(route('profiles.show', $user->username));
    }

    public function updateAvatar(AvatarRequest $request)
    {
        $image = User::uploadImage(request('avatar'), 'public/uploads/avatar');
        $user = Auth::user();
        $user->deleteImage();
        $user->avatar = $image;
        $user->save();
        return redirect(route('profiles.edit', $user->username));
    }

    public function destroy(User $user)
    {
        $user->delete();
    }

    public function invite(User $user, Project $project)
    {
        if (!$project->users()->where('role', 'creator')->firstOrFail()->is(Auth::user())) {
            abort(403, 'Unauthorized action.');
        }
        $user->invite($project);
        return redirect(route('profiles.show', $user->username));
    }
}
