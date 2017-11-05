@extends('layouts.master')

@section('content')

<div class="container-fluid">
    <h2>Ort bearbeiten</h2>

    <div id="#map"></div>

    <div class="row">
        <div class="col-md-4">
            <form method="POST" action="{{ route('locations.update', ['id' => $location->id]) }}">
                {{ csrf_field() }}
                <input type="hidden" name="_method" value="PUT">

                <div class="form-group">
                    <label for="name">Name:</label>
                    <div class="d-flex align-items-center">
                        <input type="text" id="name" name="name" value="{{ $location->name }}" class="form-control mr-2">
                        <a href="#" id="refresh-button">
                            <i class="fa fa-refresh" aria-hidden="true"></i>
                        </a>
                    </div>
                </div>

                <input type="hidden" id="latitude" name="latitude" value="{{ $location->latitude }}" class="form-control" readonly>
                <input type="hidden" id="longitude" name="longitude" value="{{ $location->longitude }}" class="form-control" readonly>

                <button type="submit" class="btn btn-primary">Speichern</button>
            </form>
        </div>
    </div>

    <hr>

    <div id="editor-map" class="map"></div>
    
    <hr>

    @include('partials.back-button')

</div>

@endsection


@section('scripts')

<script>

var place = JSON.parse('{!! json_encode($location) !!}');
console.log('Location: ', place);
var editorMap = L.map('editor-map').setView([place.latitude, place.longitude], 7);
    
L.tileLayer('https://api.tiles.mapbox.com/v4/{id}/{z}/{x}/{y}.png?access_token={accessToken}', {
    attribution: 'Map data &copy; <a href="http://openstreetmap.org">OpenStreetMap</a> contributors, <a href="http://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="http://mapbox.com">Mapbox</a>',
    maxZoom: 18,
    id: 'mapbox.streets',
    accessToken: 'pk.eyJ1IjoidGhzbmV1bWFubiIsImEiOiJjajBiMGNpbnQwMXo0MzJsM3JrMmVvaW9xIn0._JPXczrSxb1MBYdvpc16WQ'
}).addTo(editorMap);

var marker = L.marker([place.latitude, place.longitude]).addTo(editorMap);
marker.bindPopup('<b>' + place.name + '</b>');

var refreshButton = document.getElementById('refresh-button');
refreshButton.addEventListener('click', function(event) {
    event.preventDefault();
    
    updateMap();
});

var nameInput = document.getElementById('name');
nameInput.addEventListener('keypress', function(event) {
    if (event.keyCode !== 13) return;

    updateMap();
    event.preventDefault();
    return false;    
});

function updateMap() {
    var input = document.getElementById('name').value;
    var url = 'http://open.mapquestapi.com/nominatim/v1/search.php?key=GnlgEeqqbhpwGfztQOiVmwwolGEnV5AX&format=json&q=';
    $.getJSON(url + input, function(results) {
        if (results === undefined) return;

        var newLocation = results[0];
        var latLng = {lat: newLocation.lat, lng: newLocation.lon};
        marker.setLatLng(latLng);
        marker.setPopupContent('<b>' + input + '</b>');
        editorMap.panTo(latLng);

        document.getElementById('latitude').value = latLng.lat;
        document.getElementById('longitude').value = latLng.lng;
    });
}


</script>

@endsection