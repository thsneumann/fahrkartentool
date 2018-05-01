<a href="{{ asset('img/tickets/' . $ticket->image) }}" data-fancybox data-caption="{{ $ticket->signature }}">
    <img class="img-thumbnail" src="{{ asset('img/tickets/thumbs/' . $ticket->thumb) }}" alt="{{ $ticket->signature }}">
</a>