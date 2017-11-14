

<div class="row">
    <div class="col-lg-5">
        <figure class="figure-medium">
            @include('partials.ticket-thumb', ['ticket' => $ticket])
            <figcaption class="figure-caption">{{ $ticket->signature }}</figcaption>
        </figure>
    </div>
    <div class="col-lg-7">
        <form method="POST" action="{{ route('tickets.update', ['id' => $ticket->id]) }}">
            {{ csrf_field() }}
            <input type="hidden" name="_method" value="PUT">
            <input type="hidden" name="redirect" value="{{ $redirect or '' }}">

            <div class="form-group">
                <label for="description">Beschreibung:</label>
                <textarea id="description" name="description" class="form-control"></textarea>
            </div>

            <div class="form-group">
                <label for="point_of_departure">Abfahrtsort:</label>
                <div class="d-flex">
                    <select name="point_of_departure_id" id="point_of_departure_id" class="form-control custom-select mr-3">
                    @foreach ($locations as $location)
                        <option value="{{ $location->id }}" {{ $location->id == $ticket->point_of_departure_id ? 'selected' : '' }}>{{ $location->name }}</option>
                    @endforeach
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label for="destination">Zielort:</label>
                <div class="d-flex">
                    <select id="destination_id" name="destination_id" class="form-control custom-select mr-3">
                    @foreach ($locations as $location)
                        <option value="{{ $location->id }}" {{ $location->id == $ticket->destination_id ? 'selected' : '' }}>{{ $location->name }}</option>
                    @endforeach
                    </select>
                </div>
            </div>

            <div class="form-group">
                <a href="{{ route('game.add-location') }}" role="button" class="btn btn-primary mb-3">
                    <i class="fa fa-plus" aria-hidden="true"></i>
                    Ort hinzufügen
                </a>
            </div>

            {{-- TODO: TAGS SELECT
            <div class="form-group">
                <label for="tag_ids">Tags:</label>
                <select id="tag_ids" name="tag_ids" class="form-control custom-select" multiple>
                @foreach ($tags as $tag)
                    TODO
                @endforeach
                </select>
            </div>
            --}}

            <button type="submit" class="btn btn-primary">Speichern</button>
        </form>
    </div>
</div>