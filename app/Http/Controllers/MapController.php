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

        return view('map.index', ['tickets' => $tickets]);
    }
}
