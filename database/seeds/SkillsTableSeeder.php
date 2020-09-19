<?php

use App\Skill;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;


class SkillsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
        {
            $json = File::get((base_path('database/data/skills.json')));
            $data = json_decode($json,true);
            foreach ($data as $obj) {
                Skill::create($obj);
            }
        }
}
