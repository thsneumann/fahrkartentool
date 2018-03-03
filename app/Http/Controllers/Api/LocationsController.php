<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Location;

class LocationsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Location::all();
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
        $location->longname = $request['longname'];
        $location->lat = round($request['lat'], 5);
        $location->lng = round($request['lng'], 5);
        $location->save();
        
        return $location;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Location::findOrFail($id);
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function outgoing($id)
    {
        $location = Location::findOrFail($id);
        $outgoing = [];
        $tickets = $location->pointOfDepartureFor;
       
        foreach ($tickets as $ticket) {
            $outgoing[] = ['lat' => $ticket->destination->lat, 'lng' => $ticket->destination->lng];
        }

        return $outgoing;
    }

    public function incoming($id)
    {
        $location = Location::findOrFail($id);
        $incoming = [];
        $tickets = $location->destinationFor;
       
        foreach ($tickets as $ticket) {
            $incoming[] = ['lat' => $ticket->pointOfDeparture->lat, 'lng' => $ticket->pointOfDeparture->lng];
        }

        return $incoming;
    }
}
