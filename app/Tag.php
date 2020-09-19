<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    public function users() {
        return $this->belongsToMany(User::class, 'user_tag');
    }

    public function projects() {
        return $this->belongsToMany(Project::class, 'project_tag');
    }
}
