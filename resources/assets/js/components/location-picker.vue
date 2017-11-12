<template>

<div class="vue-location-picker">
    <div class="form-group">
        <label for="name">Name:</label>
        <div class="d-flex align-items-center">
            <input type="text" id="name" name="name" v-model="input" class="form-control mr-2">
            <a href="#" @click.prevent="updateMap">
                <i class="fa fa-refresh" aria-hidden="true"></i>
            </a>
        </div>
        <input type="hidden" id="latitude" name="latitude" :value="location.latitude" class="form-control" readonly>
        <input type="hidden" id="longitude" name="longitude" :value="location.longitude" class="form-control" readonly>
    </div>

    <div id="location-picker-map" class="map form-group"></div>
</div>

</template>

<script>
import config from "../config";

export default {
  props: {
    defaultLocation: {
      type: Object
    }
  },
  data() {
    return {
      location: {
          latitude: config.mapCenter.lat,
          longitude: config.mapCenter.lng
      },
      map: null,
      marker: null,
      input: null
    };
  },
  methods: {
    initMap() {
      this.map = L.map("location-picker-map").setView(
        [this.location.latitude, this.location.longitude],
        7
      );
      L.tileLayer(
        "https://api.tiles.mapbox.com/v4/{id}/{z}/{x}/{y}.png?access_token={accessToken}",
        {
          attribution:
            'Map data &copy; <a href="http://openstreetmap.org">OpenStreetMap</a> contributors, <a href="http://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="http://mapbox.com">Mapbox</a>',
          maxZoom: 18,
          id: "mapbox.streets",
          accessToken: config.leafletAccessToken
        }
      ).addTo(this.map);
    },

    addMarker() {
      this.marker = L.marker([
        this.location.latitude,
        this.location.longitude
      ]).addTo(this.map);
      this.marker.bindPopup("<b>" + this.location.name + "</b>");
    },

    updateMap() {
      axios.get(config.geocoderUrl + this.input).then(response => {
        if (response.data.length === 0) return;

        const newLocation = response.data[0];
        const latLng = { lat: newLocation.lat, lng: newLocation.lon };
        this.marker.setLatLng(latLng);
        this.marker.setPopupContent("<b>" + this.input + "</b>");
        this.map.panTo(latLng);

        this.location.latitude = latLng.lat;
        this.location.longitude = latLng.lng;
      });
    }
  },

  created() {
    if (this.defaultLocation) {
        this.location = this.defaultLocation;
        this.input = this.defaultLocation.name;
    }
  },

  mounted() {
    this.initMap();
    this.addMarker();

    /*

    var nameInput = document.getElementById("name");
    nameInput.addEventListener("keypress", function(event) {
      if (event.keyCode !== 13) return;

      updateMap();
      event.preventDefault();
      return false;
    });

    function updateMap() {
      var input = document.getElementById("name").value;
      var url =
        "http://open.mapquestapi.com/nominatim/v1/search.php?key=GnlgEeqqbhpwGfztQOiVmwwolGEnV5AX&format=json&q=";
      $.getJSON(url + input, function(results) {
        console.log(results);
        if (results === undefined) return;

        var newLocation = results[0];
        var latLng = { lat: newLocation.lat, lng: newLocation.lon };
        marker.setLatLng(latLng);
        marker.setPopupContent("<b>" + input + "</b>");
        editorMap.panTo(latLng);

        document.getElementById("latitude").value = latLng.lat;
        document.getElementById("longitude").value = latLng.lng;
      });
    } */
  }
};
</script>