<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(TagsTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(ProjectsTableSeeder::class);
        $this->call(SkillsTableSeeder::class);

        $users = App\User::all();

        App\Project::all()->each(function ($project) use ($users){
            $project->users()->attach(
                $users->random(rand(1,1))->pluck('id')->toArray(),
                ['role' => 'creator']
            );
        });

        $tags = App\Tag::all();

        App\User::all()->each(function ($user) use ($tags) {
            $user->tags()->attach(
                $tags->random(rand(1, 3))->pluck('id')->toArray()
            );
        });

        App\Project::all()->each(function ($project) use ($tags) {
            $project->tags()->attach(
                $tags->random(rand(1, 3))->pluck('id')->toArray()
            );
        });

        $skills = App\Skill::all();
/*
        App\User::all()->each(function ($user) use ($skills) {
            $user->skills()->attach(
                $skills->random(rand(1, 3))->pluck('id')->toArray()
            );
        });
*/
        App\Project::all()->each(function ($project) use ($skills) {
            $project->skills()->attach(
                $skills->random(rand(1, 3))->pluck('id')->toArray()
            );
        });


    }
}
