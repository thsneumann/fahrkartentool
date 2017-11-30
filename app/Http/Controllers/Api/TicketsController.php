<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use App\Http\Controllers\Controller;
use App\Ticket;

class TicketsController extends Controller
{
    private function toCSV($tickets)
    {
        $headings = ['ID', 'Signatur', 'Abfahrtsort', 'Ziel', 'Beschreibung', 'Kategorie', 'Klasse', 'Preis', 'Bearbeitungen', 'Änderungsdatum'];
        $output = implode(',', $headings) . PHP_EOL;
        foreach ($tickets as $ticket) {
            $columns = [
                $ticket->id,
                $ticket->signature,
                $ticket->pointOfDeparture ? $ticket->pointOfDeparture->name : '',
                $ticket->destination ? $ticket->destination->name : '',
                $ticket->description,
                $ticket->category ? $ticket->category->name : '',
                $ticket->vehicleClass ? $ticket->vehicleClass->name : '',
                $ticket->price ? $ticket->price : '',
                $ticket->edit_count,
                $ticket->updated_at
            ];
            $output.=  implode(',', $columns) . PHP_EOL;
        }
        $headers = array(
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="all_tickets_export.csv"',
        );
          
        return Response::make($output, 200, $headers);
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
        $tickets = Ticket::all();

        if ($request['format'] == 'csv') {
            return $this->toCSV($tickets);
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
}
