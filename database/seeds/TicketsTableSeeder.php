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
        $basePath = 'public/img/tickets';
        $dir = opendir($basePath);
        $files = [];
        while ($file = readdir($dir)) {
            $pathinfo = pathinfo($file);
            if (isset($pathinfo['extension']) && $pathinfo['extension'] == 'png') {
                $files[] = $file;
            }
        }
        closedir($dir);

        foreach ($files as $file) {
            $pathinfo = pathinfo($file);
            // dd($file);
            $ticket = new Ticket();
            $ticket->signature = $pathinfo['filename'];
            $ticket->image = $file;
            $ticket->thumb = $pathinfo['filename'] . '.jpg';
            $ticket->save();

            // Create thumbnail
            $img = Image::make($basePath . '/' . $file)->heighten(300);
            $img->save($basePath . '/' . $pathinfo['dirname'] . '/thumbs/' . $ticket->thumb, 80);
        }
    }
}
