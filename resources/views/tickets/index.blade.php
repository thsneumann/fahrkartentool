@extends('layouts.master')

@section('content')

<div class="container-fluid">
    <a target="_blank" href="{{ route('api.tickets.index', ['format' => 'csv']) }}" class="btn btn-primary mb-3 csv-link">
        <i class="fa fa-download" aria-hidden="true"></i>
        CSV-Export
    </a>
    <div class="alert alert-warning csv-warning">
        Aufgrund technischer Einschränkungen können zur Zeit nur maximal 5000 Datensätze zur Verfügung gestellt werden.
    </div>

    <table class="table tickets-table">
        <thead>
            <th scope="col">#</th>
            <th scope="col">Signatur</th>
            <th scope="col">Bild</th>
            <th scope="col">bearbeitet?</th>
            <th scope="col">Abfahrtsort</th>
            <th scope="col">Zwischenstationen</th>
            <th scope="col">Ziel</th>
            <th scope="col">Datum</th>
            <th scope="col">Beschreibung</th>
            <th scope="col">Kategorie</th>
            <th scope="col">Klasse</th>
            <th scope="col">Preis</th>
            <th scope="col">Aktionen</th>
        </thead>
        <tbody>
            @foreach ($tickets as $ticket)
                <tr>
                    <th scope="row">{{ $ticket->id }}</th>
                    <td>{{ $ticket->signature }}</td>
                    <td>
                        @include('partials.ticket-thumb', ['ticket' => $ticket])
                    </td>
                    <td>
                        @if ($ticket->edit_count > 0)
                            <i class="fa fa-check" aria-hidden="true"></i>
                        @else
                            <i class="fa fa-times" aria-hidden="true"></i>
                        @endif
                    </td>
                    <td>
                        @if ($ticket->origin())
                            <a href="{{ route('locations.edit', ['id' => $ticket->origin()->id]) }}">{{ $ticket->origin()->name }}</a>
                        @endif
                    </td>
                    <td>
                        @if ($ticket->stopovers())
                            @foreach ($ticket->stopovers() as $stopover)
                                <a href="{{ route('locations.edit', ['id' => $stopover->id]) }}">{{ $stopover->name }}</a><br>
                            @endforeach
                        @endif
                    </td>
                    <td>
                        @if ($ticket->destination())
                            <a href="{{ route('locations.edit', ['id' => $ticket->destination()->id]) }}">{{ $ticket->destination()->name }}</a>
                        @endif        
                    </td>
                    <td>
                        @if ($ticket->date)
                            {{ $ticket->date->format('d. m. Y') }}
                        @endif
                    </td>
                    <td>
                        @if ($ticket->description)
                            {{ $ticket->description }}
                        @endif
                    </td>
                    <td>
                        @if ($ticket->category)
                            {{ $ticket->category->name }}
                        @endif
                    </td>
                    <td>
                        @if ($ticket->vehicleClass)
                            {{ $ticket->vehicleClass->name }}
                        @endif
                    </td>
                    <td>
                        {{ $ticket->price }}
                    </td>

                    <td class="d-flex">
                        <a href="{{ route('tickets.edit', ['id' => $ticket->id]) }}" class="btn btn-sm btn-primary mr-2" role="button">
                            <i class="fa fa-pencil" aria-hidden="true"></i>
                        </a>
                        @if (Auth::check() && Auth::user()->is_admin)
                            <form method="POST" action="{{ route('tickets.destroy', ['id' => $ticket->id]) }}">
                                {{ csrf_field() }}
                                <input type="hidden" name="_method" value="DELETE">
                                <button type="submit" class="btn btn-sm btn-danger">
                                    <i class="fa fa-eraser" aria-hidden="true"></i>
                                </button>
                            </form>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $tickets->links() }}

</div>
    
</body>
</html>
@endsection