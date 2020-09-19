<?php

use App\Tag;
use Illuminate\Database\Seeder;

class TagsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $json = File::get((base_path('database/data/tags.json')));
        $data = json_decode($json,true);
        foreach ($data as $obj) {
            Tag::create($obj);
        }
    }
}
