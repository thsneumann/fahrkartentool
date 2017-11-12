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

    public function edit()
    {
        $ticket = Ticket::where('edit_count', 0)->first();
        return view('game.edit', [
            'ticket' => $ticket,
            'locations' => Location::all()
        ]);
    }
}
