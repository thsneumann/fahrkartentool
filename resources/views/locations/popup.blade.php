<div class="map-popup">
    <h3>{{ $location->name }}</h3>
    
    @if (count($podTickets) > 0)
        <h4>Tickets mit diesem Abfahrtsort</h4>
        <ul class="ticket-list">
        @foreach ($podTickets as $ticket)
            <li>
            @include('partials.ticket-thumb', ['ticket' => $ticket])
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
            </li>
        @endforeach
    @endif
</div>
