<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
// use Intervention\Image\ImageManagerStatic as Image;
use Intervention\Image\Facades\Image;
use App\Ticket;

class GenerateThumbnails extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tickets:thumbs';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate thumbnails from the tickets in the public/img/tickets folder';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $basePath = realpath('public/img/tickets');
        $thumbsPath = $basePath . '/thumbs/';

        // Check if thumbnail directory exists
        if (!is_dir($thumbsPath)) {
            mkdir($thumbsPath);
            $this->info('created thumbnail directory');
        }

        // Read list of ticket images in jpg format
        $dir = opendir($basePath);
        $files = [];
        while ($file = readdir($dir)) {
            $pathinfo = pathinfo($file);
            if (isset($pathinfo['extension']) && $pathinfo['extension'] == 'jpg') {
                $files[] = $file;
            }
        }
        closedir($dir);

        // Create thumbnails
        foreach($files as $file) {
            $thumb = $thumbsPath . $file;

            if (file_exists($thumb)) {
                $this->comment('Skipped ' . $file . ', thumbnail exists.');
            } else {
                $img = Image::make($basePath . '/' . $file)->heighten(300);
                $img->save($thumb, 80);
                $this->line('Created thumbnail for ' . $file . '.');
            }
        }
        $this->info('All thumbnails created.');
    }
}
