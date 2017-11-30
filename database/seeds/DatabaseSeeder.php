<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(LocationsTableSeeder::class);
        // $this->call(TagsTableSeeder::class);
        $this->call(VehicleClassesTableSeeder::class);
        $this->call(CategoriesTableSeeder::class);
        $this->call(TicketsTableSeeder::class);
    }
}
