<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Project extends Model
{
    use SoftDeletes;

    /**
     * The attributes that should be mutated to dates.
     * @var array
     */
    protected $dates = ['deleted_at'];

    protected $guarded = [];

    public function path()
    {
        return route('projects.show', $this);
    }

    public function tags() {
        return $this->belongsToMany(Tag::class, 'project_tag');
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'project_user')->withPivot('role');
    }
    public function skills(){
        return $this->belongsToMany(Skill::class);
    }

}
