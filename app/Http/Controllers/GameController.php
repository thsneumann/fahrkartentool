<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Ticket;
use App\Location;

class GameController extends Controller
{
    public function index()
    {
        $points = session()->get('points');
        
        if ($points > 0) {
            return $this->tagging();
        }
        
        return view('game.welcome');
    }

    public function tagging()
    {
        $ticket = Ticket::where('edit_count', 0)->first();

        $points = session()->get('points', 0);

        return view('game.tagging', [
            'ticket' => $ticket,
            'locations' => Location::orderBy('name')->get(),
            'points' => $points
        ]);
    }

    public function addLocation()
    {
        return view('locations.create', ['redirect' => 'game.tagging']);
    }
}
