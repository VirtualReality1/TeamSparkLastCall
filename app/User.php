<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
        'username',
        'selfdescription',
        'firstName',
        'lastName',
        'email',
        'password',
        'showMail',
        'dataPrivacy',
        'tos'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token','dob'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function tags() {
        return $this->belongsToMany(Tag::class, 'user_tag');
    }

    public function projects()
    {
        return $this->belongsToMany(Project::class, 'project_user');
    }
    public function skills(){
        return $this->belongsToMany(Skill::class);
    }
    public function invite(Project $project){
        if($project->users()->where('role','=','invited')->get()->contains($this->id)){
            $project->users()->detach($this->id);
        }
        else{
            if($project->users()->where('role','=','interested')->get()->contains($this->id)){
                $project->users()->detach($this->id);
                $project->users()->attach($this,['role'=> 'member']);
            }
            else{
                $project->users()->attach($this,['role'=> 'invited']);
            }
        }
    }

    public static function uploadImage($image, string $path)
    {
        return $image->store($path);
    }

    public function deleteImage()
    {
        if ($this->avatar) {
            Storage::delete($this->avatar);
        }
    }

    public function getAvatar()
    {
        if ($this->avatar) {
            return Storage::url($this->avatar);
        }
        return ('/uploads/avatar/default.jpg');
    }
}
