<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Ticket;
use App\Location;

class MapController extends Controller
{
    /**
     * Show a map of all tickets
     */
    public function index()
    {
        $tickets = Ticket::all();

        /* $connections = [];

        foreach ($tickets as $ticket) {
            if (!($ticket->pointOfDeparture && $ticket->destination)) continue;
            
            $connections[] = [
                [$ticket->pointOfDeparture->latitude, $ticket->pointOfDeparture->longitude],
                [$ticket->destination->latitude, $ticket->destination->longitude]
            ];
        }
 */
        return view('map.index', ['tickets' => $tickets]);
    }
}
