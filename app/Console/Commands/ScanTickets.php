<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Ticket;

class ScanTickets extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tickets:scan';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Scan the public/img/tickets folder for new tickets and populate database';

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
        // Go through all the files in the public/img/tickets folder and create database entries for new tickets
        $basePath = 'public/img/tickets/';
        $dir = opendir($basePath);
        $files = [];
        while ($file = readdir($dir)) {
            $pathinfo = pathinfo($file);
            if (isset($pathinfo['extension']) && $pathinfo['extension'] == 'jpg') {
                $files[] = $file;
            }
        }
        closedir($dir);

        $this->info('found ' . count($files) . ' tickets');

        foreach ($files as $file) {
            $pathinfo = pathinfo($file);
            $signature = $pathinfo['filename'];
            
            $ticket = Ticket::where('signature', $signature)->first();
            if ($ticket !== null) {
                $this->comment($signature . ' already in database, skipping.');
                continue;
            }

            $ticket = new Ticket();
            $ticket->signature = $signature;
            $ticket->image = $file;
            $ticket->thumb = $pathinfo['filename'] . '.jpg';
            $ticket->save();
            $this->info('Created database entry for ticket with signature ' . $signature);
        }
    }
}
