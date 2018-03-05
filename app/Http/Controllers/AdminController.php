<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Ticket;
use App\User;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the admin area.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('access-admin');

        $users = User::all();

        $ticketsCount = Ticket::count();
        $editedTicketsCount = Ticket::where('edit_count', '>', 0)->count();

        return view('admin.index', compact('users', 'ticketsCount', 'editedTicketsCount'));
    }
}
