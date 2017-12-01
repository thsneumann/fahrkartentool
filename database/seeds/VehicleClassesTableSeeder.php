<?php

use Illuminate\Database\Seeder;
use App\VehicleClass;

class VehicleClassesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $vehicleClasses = ['1. Klasse', '2. Klasse', '3. Klasse', '4. Klasse', 'Sonstige'];
        foreach($vehicleClasses as $vehicleClass) {
            VehicleClass::create(['name' => $vehicleClass]);
        }
    }
}
