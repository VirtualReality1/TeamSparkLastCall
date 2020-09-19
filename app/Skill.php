<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{
    public function projects(){
        return $this->belongsToMany(Project::class);
    }
}
