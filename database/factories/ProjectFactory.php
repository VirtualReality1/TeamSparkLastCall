<?php

/** @var Factory $factory */

use App\Project;
use App\User;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

$factory->define(Project::class, function (Faker $faker) {
    return [
        //'user_id' => factory(User::class),
        'title' => '[Beispiel] ' . $faker->sentence(6, true),
        'summary' => $faker->paragraph(3, true),
        'content' => $faker->text(555),
        'teamStatus' => $faker->randomElement(['searching', 'complete', 'finished']),
        'projectStatus' => $faker->randomElement(['preparation', 'going', 'paused', 'successful', 'aborted'])
    ];
});
