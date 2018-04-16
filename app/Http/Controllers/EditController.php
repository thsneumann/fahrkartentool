<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Ticket;
use App\Location;
use App\User;
use App\Category;
use App\VehicleClass;

class EditController extends Controller
{
    private $playModes = ['add', 'check'];

    public function index()
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

        return view('edit.index', [
            'mode' => $mode,
            'ticket' => $ticket,
            'locations' => Location::orderBy('name')->get(),
            'categories' => Category::orderBy('name')->get(),
            'vehicleClasses' => VehicleClass::all(),
            'points' => $points
        ]);
    }

    public function highscore()
    {
        $users = User::where('points', '>', 0)->orderBy('points', 'desc')->get();
        return view('edit.highscore', ['users' => $users]);
    }

    private function getRandomPlayMode()
    {
        return $this->playModes[rand(0, count($this->playModes) - 1)];
    }
}
