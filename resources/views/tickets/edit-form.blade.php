

<form method="POST" action="{{ route('tickets.update', ['id' => $ticket->id]) }}">

    <div class="row">
        <div class="col-md-4 text-center">
            <figure class="d-inline-block max-w-100p">
                @include('partials.ticket-thumb', ['ticket' => $ticket])
                <figcaption class="figure-caption text-left">{{ $ticket->signature }}</figcaption>
            </figure>
        </div>
        <div class="col-md-8">
                {{ csrf_field() }}
                <input type="hidden" name="_method" value="PUT">
                @if (isset($redirect))
                    <input type="hidden" name="redirect" value="{{ $redirect }}">
                @endif
                @if (isset($points))
                    <input type="hidden" name="points" value="{{ $points }}">
                @endif

                <ticket-locations-picker :default-locations="{{ json_encode($ticket->locations()->orderBy('index')->get() )}}" ></ticket-locations-picker>

                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="date">Datum:</label><br>
                            <input type="date" name="date" value="{{ $ticket->date ? $ticket->date->toDateString() : '' }}" min="1850-01-01" max="1925-12-31" class="form-control">
                            <small>Muss zwischen 1850 und 1925 liegen.</small>
                        </div>
                    </div>
                    <div class="col-sm-6">
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
                    </div>
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

                <button type="submit" class="btn btn-lg btn-primary">Speichern</button>
        </div>
    </div>

</form>