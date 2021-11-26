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
        $this->call(VehicleClassesTableSeeder::class);
        $this->call(CategoriesTableSeeder::class);
        $this->call(TicketsTableSeeder::class);
        // $this->call(LocationsTableSeeder::class);
        $this->call(UsersTableSeeder::class);
    }
}
