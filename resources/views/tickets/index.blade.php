@extends('layouts.master')

@section('content')

<div class="container-fluid">
    <a target="_blank" href="{{ route('api.tickets.index', ['format' => 'csv']) }}" class="btn btn-primary mb-3">
        CSV-Export
    </a>

    <table class="table tickets-table">
        <thead>
            <th scope="col">#</th>
            <th scope="col">Signatur</th>
            <th scope="col">Bild</th>
            <th scope="col">bearbeitet?</th>
            <th scope="col">Abfahrtsort</th>
            <th scope="col">Ziel</th>
            <th scope="col">Beschreibung</th>
            <th scope="col">Kategorie</th>
            {{-- <th scope="col">Tags</th> --}}
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
                        @if ($ticket->pointOfDeparture)
                            <a href="{{ route('locations.edit', ['id' => $ticket->point_of_departure_id]) }}">{{ $ticket->pointOfDeparture->name }}</a>
                        @endif
                    </td>
                    <td>
                        @if ($ticket->destination)
                            <a href="{{ route('locations.edit', ['id' => $ticket->destination_id]) }}">{{ $ticket->destination->name }}</a>
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
                    {{-- <td>
                        <ul class="list-inline">
                            @foreach ($ticket->tags as $tag)
                                <li class="list-inline-item">
                                    <a href="{{ route('tags.edit', ['id' => $tag->id]) }}">{{ $tag->name }}</a>{{ !$loop->last ? ', ' : '' }}
                                </li>
                            @endforeach
                        </ul>
                    </td> --}}
                    <td class="d-flex">
                        <a href="{{ route('tickets.edit', ['id' => $ticket->id]) }}" class="btn btn-sm btn-primary mr-2" role="button">
                            <i class="fa fa-pencil" aria-hidden="true"></i>
                        </a>
                        <form method="POST" action="{{ route('tickets.destroy', ['id' => $ticket->id]) }}">
                            {{ csrf_field() }}
                            <input type="hidden" name="_method" value="DELETE">
                            <button type="submit" class="btn btn-sm btn-danger">
                                <i class="fa fa-trash" aria-hidden="true"></i>
                            </button>
                        </form>
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