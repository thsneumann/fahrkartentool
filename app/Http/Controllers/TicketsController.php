<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Ticket;
use App\Location;
use App\Tag;

class TicketsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return view('tickets.index')->with('tickets', Ticket::paginate(20));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        dd('show ticket');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('tickets.edit', [
        'ticket' => Ticket::findOrFail($id),
        'locations' => Location::orderBy('name')->get(),
        'tags' => Tag::orderBy('name')->get()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Ticket $ticket)
    {
        $ticket->point_of_departure_id = $request['point_of_departure_id'];
        $ticket->destination_id = $request['destination_id'];
        $ticket->description = $request['description'];
        $ticket->edit_count += 1;

        if ($request->has('points')) {
            $points = $request['points'];
            session()->put('points', $points + 1);
            // save points for logged in user
            if (auth()->check()) {
                $user = auth()->user();
                $user->points = $points + 1;
                $user->save();
            }
        }
    
        $ticket->save();

        if ($request['redirect'] == 'back') {
            return back();
        }

        return redirect(route('tickets.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ticket $ticket)
    {
        $ticket->delete();

        return redirect(route('tickets.index'));
    }
}
