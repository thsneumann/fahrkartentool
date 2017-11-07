<?php

use Illuminate\Database\Seeder;
use App\Tag;

class TagsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(\Faker\Generator $faker)
    {
        $max = 100;
        for ($i = 0; $i < $max; $i++) {
            $tag = new Tag();
            $tag->name = $faker->word();
            $tag->save();
        }
    }
}
