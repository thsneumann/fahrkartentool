<div class="map-popup">
    <h3>{{ $location->name }}</h3>
    
    @if (count($ticketsWithOrigin) > 0)
        <h4>Tickets mit diesem Abfahrtsort</h4>
        <ul class="ticket-list">
        @foreach ($ticketsWithOrigin as $ticket)
            <li>
                @include('partials.ticket-thumb', ['ticket' => $ticket])
                <a href="{{ route('tickets.edit', ['id' => $ticket->id]) }}" class="btn btn-sm btn-primary mr-2" role="button">
                    <i class="fa fa-pencil" aria-hidden="true"></i>
                </a>
            </li>
        @endforeach
        </ul>
    @endif
    
    @if (count($ticketsWithDestination) > 0)
        <h4>Tickets mit diesem Zielort</h4>
        <ul class="ticket-list">
        @foreach ($ticketsWithDestination as $ticket)
            <li>
                @include('partials.ticket-thumb', ['ticket' => $ticket])
                <a href="{{ route('tickets.edit', ['id' => $ticket->id]) }}" class="btn btn-sm btn-primary mr-2" role="button">
                    <i class="fa fa-pencil" aria-hidden="true"></i>
                </a>
            </li>
        @endforeach
    @endif

    @if (count($ticketsWithOrigin) == 0 && count($ticketsWithDestination) == 0)
        <p><em>Diesem Ort wurde noch nicht als Abfahrts- oder Zielort zugeordnet.</em></p>
    @endif
</div>
