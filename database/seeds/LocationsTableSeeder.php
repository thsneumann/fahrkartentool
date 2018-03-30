<?php

use Illuminate\Database\Seeder;
use App\Location;

class LocationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker\Generator $faker)
    {
        return;

        $faker = Faker\Factory::create();

        $max = 100;

        for ($i = 0; $i < $max; $i++) {
            $location = new Location();
            $location->name = $faker->city;
            $location->longname = $location->name;
            $location->lat = $faker->latitude(40, 60);
            $location->lng = $faker->longitude(-10,40);
            $location->save();
        }
    }
}
