<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Ticket;
use App\Location;

class GameController extends Controller
{
    public function index()
    {
        return view('game.index');
    }

    public function tagging()
    {
        $ticket = Ticket::where('edit_count', 0)->first();
        return view('game.tagging', [
            'ticket' => $ticket,
            'locations' => Location::orderBy('name')->get()
        ]);
    }

    public function addLocation()
    {
        return view('locations.create', ['redirect' => 'game.tagging']);
    }
}
