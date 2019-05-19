<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use App\Http\Controllers\Controller;
use App\Ticket;

class TicketsController extends Controller
{
    private function toCSV()
    {
        $csvExporter = new \Laracsv\Export();
        $tickets = Ticket::with(['locations'])->take(5000)->get();

        $csvExporter->beforeEach(function ($ticket) {
            if ($ticket->origin()) {
                $ticket->origin_name = $ticket->origin()->name;
                $ticket->origin_longname = $ticket->origin()->longname;
            }
            if ($ticket->stopovers()) $ticket->stopover_names = $ticket->stopovers()->implode('name', ', ');
            if ($ticket->destination()) {
                $ticket->destination_name = $ticket->destination()->name;
                $ticket->destination_longname = $ticket->destination()->longname;
            }
            if ($ticket->category) $ticket->category_name = $ticket->category->name;
            if ($ticket->vehicleClass) $ticket->vehicleClass_name = $ticket->vehicleClass->name;
        });
        $csvExporter->build($tickets, 
            ['id' => 'ID', 
             'signature' => 'Signatur', 
             'origin_name' => 'Abfahrtsort',
             'origin_longname' => 'Abfahrtsort (lang)',
             'stopover_names' => 'Zwischenhalte',
             'destination_name' => 'Ziel',
             'destination_longname' => 'Ziel (lang)',
             'description' => 'Beschreibung',
             'category_name' => 'Kategorie',
             'vehicleClass_name' => 'Klasse',
             'price' => 'Preis',
             'edit_count' => 'Anzahl Bearbeitungen',
             'updated_at' => 'Änderungsdatum',
            ])->download();
    }

    private function filter($request)
    {
        $query = Ticket::query();
        $filters = explode(',', $request->input('filter'));
        foreach ($filters as $filter) {
            list($criteria, $value) = explode(':', $filter);
            $query->where($criteria, $value);
        }
        return $query->get();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request['format'] == 'csv') {
            return $this->toCSV();
        }

        if ($request->has('filter')) {
            return $this->filter($request);
        }

        return Ticket::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Ticket::create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Ticket::findOrFail($id);
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
        $ticket = Ticket::findOrFail($id);
        $ticket->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $ticket = Ticket::findOrFail($id);
        $ticket->delete();
    }

    /**
     * Get a given amount of randomly chosen tickets
     */
    public function random($count = 10)
    {
        $tickets = Ticket::inRandomOrder()->limit($count)->get();
        return $tickets;
    }
}
