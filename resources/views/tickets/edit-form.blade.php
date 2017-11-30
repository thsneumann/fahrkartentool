

<form method="POST" action="{{ route('tickets.update', ['id' => $ticket->id]) }}">

    <div class="row">
        <div class="col-lg-5 text-center">
            <figure class="figure-medium d-inline-block">
                @include('partials.ticket-thumb', ['ticket' => $ticket])
                <figcaption class="figure-caption text-left">{{ $ticket->signature }}</figcaption>
            </figure>
        </div>
        <div class="col-lg-7">
                {{ csrf_field() }}
                <input type="hidden" name="_method" value="PUT">
                @if (isset($redirect))
                    <input type="hidden" name="redirect" value="{{ $redirect }}">
                @endif
                @if (isset($points))
                    <input type="hidden" name="points" value="{{ $points }}">
                @endif

                <div class="form-group">
                    <label for="category_id">Kategorie:</label>
                    <select id="category_id" name="category_id" class="form-control custom-select">
                        <option value="">Kategorie wählen</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}"
                            {{ $category->id == $ticket->category_id ? ' selected': '' }}
                            >{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="vehicle_class_id">Klasse:</label>
                            <select id="vehicle_class_id" name="vehicle_class_id" class="form-control custom-select">
                                <option value="">Klasse wählen</option>
                                @foreach ($vehicleClasses as $vehicleClass)
                                    <option value="{{ $vehicleClass->id }}"
                                    {{ $vehicleClass->id == $ticket->vehicle_class_id ? ' selected' : '' }}
                                    >{{ $vehicleClass->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="price">Preis:</label>
                            <input id="price" name="price" value="{{ $ticket->price }}" class="form-control">
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="description">Zusatzinformationen:</label>
                    <textarea id="description" name="description" class="form-control"></textarea>
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
        </div>
    </div>

    <ticket-locations-picker :default-point-of-departure="{{ json_encode($ticket->pointOfDeparture) }}" :default-destination="{{ json_encode($ticket->destination) }}"></ticket-locations-picker>

    <button type="submit" class="btn btn-primary">Speichern</button>
</form>