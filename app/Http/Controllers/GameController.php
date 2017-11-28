<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Ticket;
use App\Location;
use App\User;
use App\Category;

class GameController extends Controller
{
    private $playModes = ['add', 'check'];

    public function index()
    {
        $points = session()->get('points');
        
        if ($points > 0) {
            return $this->play();
        }
        
        return view('game.welcome');
    }

    public function play()
    {
        $mode = $this->getRandomPlayMode();

        if ($mode == 'check') {
            $edited_ticket_ids = session()->get('edited_ticket_ids', []);
            $ticket = Ticket::whereBetween('edit_count', [1, 2])
                ->whereNotIn('id', $edited_ticket_ids)
                ->first();
            if ($ticket == null) $mode = 'add';
        }

        if ($mode == 'add') {
            $ticket = Ticket::where('edit_count', 0)
            ->first();
        }

        $points = session()->get('points', 0);
        if ($points == 0) $mode = 'add';

        return view('game.play', [
            'mode' => $mode,
            'ticket' => $ticket,
            'locations' => Location::orderBy('name')->get(),
            'categories' => Category::orderBy('name')->get(),
            'points' => $points
        ]);
    }

    public function addLocation()
    {
        return view('locations.create', ['redirect' => 'game.play']);
    }

    public function highscore()
    {
        $users = User::where('points', '>', 0)->orderBy('points', 'desc')->get();
        return view('game.highscore', ['users' => $users]);
    }

    private function getRandomPlayMode()
    {
        return $this->playModes[rand(0, count($this->playModes) - 1)];
    }
}
