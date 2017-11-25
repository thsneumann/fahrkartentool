<?php

use Illuminate\Database\Seeder;
use App\Category;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = ['Bahnsteigkarte', 'Fahrradkarte', 'Bettkarte', 
        'Hundefahrkarte', 'Militärfahrkarte', 'Leichenfahrkarte',
        'Kinderfahrkarte', 'Zeitfahrkarte', 'Arbeiterwochenkarte',
        'Personenfahrkarte'];
        foreach ($categories as $categoryName) {
            $category = new Category();
            $category->name = $categoryName;
            $category->save();
        }
    }
}
