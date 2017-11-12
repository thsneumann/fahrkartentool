<figure class="figure-medium">
    @include('partials.ticket-thumb', ['ticket' => $ticket])
    <figcaption class="figure-caption">{{ $ticket->signature }}</figcaption>
</figure>

<div class="row">
    <div class="col-md-4">
        <form method="POST" action="{{ route('tickets.update', ['id' => $ticket->id]) }}">
            {{ csrf_field() }}
            <input type="hidden" name="_method" value="PUT">
            <input type="hidden" name="redirect" value="{{ $redirect or '' }}">

            <div class="form-group">
                <label for="point_of_departure">Abfahrtsort:</label>
                <select name="point_of_departure_id" id="point_of_departure_id" class="form-control custom-select">
                @foreach ($locations as $location)
                    <option value="{{ $location->id }}" {{ $location->id == $ticket->point_of_departure_id ? 'selected' : '' }}>{{ $location->name }}</option>
                @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="destination">Zielort:</label>
                <select name="destination_id" id="destination_id" class="form-control custom-select">
                @foreach ($locations as $location)
                    <option value="{{ $location->id }}" {{ $location->id == $ticket->destination_id ? 'selected' : '' }}>{{ $location->name }}</option>
                @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="description">Beschreibung:</label>
                <textarea id="description" name="description" class="form-control"></textarea>
            </div>

            <button type="submit" class="btn btn-primary">Save</button>
        </form>
    </div>
</div>