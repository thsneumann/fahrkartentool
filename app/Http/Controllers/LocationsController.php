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
        return view('locations.index', ['locations' => Location::paginate(20)]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
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
        $location->longname = $request['longname'];
        $location->lat = round($request['lat'], 5);
        $location->lng = round($request['lng'], 5);
        $location->save();

        return back();
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
        $location->longname = $request['longname'];
        $location->lat = $request['lat'];
        $location->lng = $request['lng'];
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
        $ticketsWithOrigin = $location->originFor;
        $ticketsWithDestination = $location->destinationFor;
        return view('locations.popup', compact('location', 'ticketsWithOrigin', 'ticketsWithDestination'));
    }
}
