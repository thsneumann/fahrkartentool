

<div class="row">
    <div class="col-lg-5 text-center">
        <figure class="figure-medium d-inline-block">
            @include('partials.ticket-thumb', ['ticket' => $ticket])
            <figcaption class="figure-caption text-left">{{ $ticket->signature }}</figcaption>
        </figure>
    </div>
    <div class="col-lg-7">
        <form method="POST" action="{{ route('tickets.update', ['id' => $ticket->id]) }}">
            {{ csrf_field() }}
            <input type="hidden" name="_method" value="PUT">
            @if (isset($redirect))
                <input type="hidden" name="redirect" value="{{ $redirect }}">
            @endif
            @if (isset($points))
                <input type="hidden" name="points" value="{{ $points }}">
            @endif

            <div class="form-group">
                <label for="point_of_departure">Abfahrtsort:</label>
                <location-picker field="point_of_departure_id" :locations="{{ json_encode($locations) }}" v-bind:default-location-id="{{ intval($ticket->point_of_departure_id) }}"></location-picker>
            </div>

            <div class="form-group">
                <label for="destination">Zielort:</label>
                <location-picker field="destination_id" :locations="{{ json_encode($locations) }}" v-bind:default-location-id="{{ intval($ticket->destination_id) }}"></location-picker>
            </div>

            <div class="form-group">
                <label for="description">Beschreibung:</label>
                <textarea id="description" name="description" class="form-control"></textarea>
            </div>

            <div class="form-group">
                <label for="category_id">Kategorie:</label>
                <select id="category_id" name="category_id" class="form-control custom-select">
                    <option value="">Kategorie wählen</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
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