<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\Ticket;
use App\Location;
use App\Tag;

class TicketsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(\Faker\Generator $faker)
    {
        // Go through all the files in the image/seed folder and create dummy database entries
        $files = Storage::disk('public')->files('image/seed');

        foreach ($files as $file) {
            $pathinfo = pathinfo($file);

            $ticket = new Ticket();
            $ticket->signature = $pathinfo['filename'];
            $ticket->image = $file;
            $ticket->point_of_departure_id = Location::inRandomOrder()->first()->id;
            $ticket->destination_id = Location::inRandomOrder()->first()->id;
            $ticket->date = $faker->dateTimeBetween('1890', '1925');
            $ticket->save();
            $tags = Tag::inRandomOrder()->take(rand(1, 4))->get();
            $ticket->tags()->attach($tags);
        }
    }
}
