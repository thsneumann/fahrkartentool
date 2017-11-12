<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Location;
use App\Ticket;

class LocationsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('locations.index', ['locations' => Location::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // return view('locations.create', ['location' => Location::first()]);
        return view('locations.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $location = new Location();
        $location->name = $request['name'];
        $location->latitude = $request['latitude'];
        $location->longitude = $request['longitude'];
        $location->save();

        return redirect(route('locations.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('locations.edit', ['location' => Location::findOrFail($id)]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $location = Location::findOrFail($id);
        $location->name = $request['name'];
        $location->latitude = $request['latitude'];
        $location->longitude = $request['longitude'];
        $location->save();

        return redirect(route('locations.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Location::destroy($id);
        
        return redirect(route('locations.index'));
    }

    public function showPopup($id)
    {
        $location = Location::findOrFail($id);
        $podTickets = Ticket::where('point_of_departure_id', $id)->get();
        $destTickets = Ticket::where('destination_id', $id)->get();
        return view('locations.popup', compact('location', 'podTickets', 'destTickets'));
    }
}
