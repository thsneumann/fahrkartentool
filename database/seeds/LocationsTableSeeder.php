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
    public function run()
    {
        $cities = json_decode(Storage::disk('public')->get('cities.json'));
        foreach ($cities as $city) {
            preg_match('/(\d+\.\d+) (\d+\.\d+)/', $city->coord, $latLng);

            $location = new Location();
            $location->name = $city->cityLabel;
            $location->latitude = $latLng[2];
            $location->longitude = $latLng[1];
            $location->save();
        }

        /* $location = new Location();
        $location->name = 'Berlin';
        $location->latitude = 52.52;
        $location->longitude = 13.40;
        $location->save(); */
    }
}
