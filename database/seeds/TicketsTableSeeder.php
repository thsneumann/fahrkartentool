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
    public function run()
    {
        // Go through all the files in the image/seed folder and create database entries
        $dir = opendir('public/img/tickets');
        $files = [];
        while ($file = readdir($dir)) {
            if ($file == '.' || $file == '..') {
                continue;
            }
        
            $files[] = $file;
        }
        closedir($dir);

        foreach ($files as $file) {
            $pathinfo = pathinfo($file);

            $ticket = new Ticket();
            $ticket->signature = $pathinfo['filename'];
            $ticket->image = $file;
            $ticket->thumb = $ticket->signature . '.jpg';
            $ticket->save();
        }
    }
}
