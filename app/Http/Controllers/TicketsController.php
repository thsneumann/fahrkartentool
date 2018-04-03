<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Ticket;
use App\Location;
use App\Tag;
use App\Category;
use App\VehicleClass;

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
        'categories' => Category::orderBy('name')->get(),
        'vehicleClasses' => VehicleClass::all(),
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
        $ticket->date = $request['date'];
        $ticket->description = $request['description'];
        $ticket->category_id = $request['category_id'];
        $ticket->vehicle_class_id = $request['vehicle_class_id'];
        $ticket->price = $request['price'];
        $ticket->edit_count += 1;

        // update locations
        $locations = json_decode($request['locations']);
        $pivotEntries = [];
        $index = 0;
        foreach ($locations as $location) {
            $id = $location->id;
            if ($id === null) {
                // round lat/lng to 5 decimal degrees
                $lat = round($location->lat, 5);
                $lng = round($location->lng, 5);
                // check if location already exists, assign existing location id or create new location entry
                $locationEntry = Location::where('lat', $lat)->where('lng', $lng)->first();
                if ($locationEntry == null) {
                    $locationEntry = new Location();
                    $locationEntry->name = $location->name;
                    $locationEntry->longname = $location->longname;
                    $locationEntry->lat = $lat;
                    $locationEntry->lng = $lng;
                    $locationEntry->save();
                }
                $id = $locationEntry->id;
            }
            if ($index == count($locations) - 1) $index = 9999;
            $pivotEntries[$id] = ['index' => $index];
            $index += 1;
        }
        $ticket->locations()->sync($pivotEntries);
        
        // save points for logged in user
        if ($request->has('points')) {
            $points = $request['points'];
            session()->put('points', $points + 1);
            if (auth()->check()) {
                $user = auth()->user();
                $user->points = $points + 1;
                $user->save();
            }
        }
    
        $ticket->save();

        // keep track of edited tickets in session
        session()->push('edited_ticket_ids', $ticket->id);

        if ($request['redirect'] == 'back') {
            return back();
        }

        return redirect(route('tickets.index'));
    }

    /**
     * Reset a ticket's edited values; tickets cannot be deleted, only resetted.
     *
     * @param  \App\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ticket $ticket)
    {
        $ticket->point_of_departure_id = null;
        $ticket->destination_id = null;
        $ticket->description = null;
        $ticket->category_id = null;
        $ticket->vehicle_class_id = null;
        $ticket->price = null;
        $ticket->edit_count = 0;

        $ticket->save();

        return redirect(route('tickets.index'));
    }
}
