<div class="map-popup">
    <h3>{{ $location->name }}</h3>
    
    @if (count($podTickets) > 0)
        <h4>Tickets mit diesem Abfahrtsort</h4>
        <ul class="ticket-list">
        @foreach ($podTickets as $ticket)
            <li>
                @include('partials.ticket-thumb', ['ticket' => $ticket])
                <a href="{{ route('tickets.edit', ['id' => $ticket->id]) }}" class="btn btn-sm btn-primary mr-2" role="button">
                    <i class="fa fa-pencil" aria-hidden="true"></i>
                </a>
            </li>
        @endforeach
        </ul>
    @endif
    
    @if (count($destTickets) > 0)
        <h4>Tickets mit diesem Zielort</h4>
        <ul class="ticket-list">
        @foreach ($destTickets as $ticket)
            <li>
                @include('partials.ticket-thumb', ['ticket' => $ticket])
                <a href="{{ route('tickets.edit', ['id' => $ticket->id]) }}" class="btn btn-sm btn-primary mr-2" role="button">
                    <i class="fa fa-pencil" aria-hidden="true"></i>
                </a>
            </li>
        @endforeach
    @endif

    @if (count($podTickets) == 0 && count($destTickets) == 0)
        <p><em>Diesem Ort wurden noch keine Tickets zugeordnet</em></p>
    @endif
</div>
