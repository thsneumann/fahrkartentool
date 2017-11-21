<template>

<div class="vue-location-editor">
    <div class="picker">
      <div class="form-group">
        <div class="d-flex align-items-center">
            <input type="text" id="name" name="name" :value="location.name" class="form-control mr-2"
            v-model="input" 
            @keydown.enter="updateMap">
            <a class="mr-2" href="#" title="Aktualisieren" @click="updateMap">
                <i class="fa fa-refresh" aria-hidden="true"></i>
            </a>
        </div>
      </div>

      <div id="vue-location-editor-map" class="map form-group"></div>
    </div>

    <input type="hidden" id="latitude" name="latitude" :value="location.latitude">
    <input type="hidden" id="longitude" name="longitude" :value="location.longitude">
</div>

</template>

<script>
import config from '../config';

export default {
  props: {
    defaultLocation: {
      type: Object
    }
  },

  data() {
    return {
      location: {
        name: null,
        latitude: null,
        longitude: null
      },
      map: null,
      marker: null,
      input: this.defaultLocation && this.defaultLocation.name
    };
  },

  methods: {
    initMap() {
      this.map = L.map('vue-location-editor-map').setView(
        [
          this.location.latitude || config.defaultLocation.latitude,
          this.location.longitude || config.defaultLocation.longitude
        ],
        7
      );

      L.tileLayer(
        'https://api.tiles.mapbox.com/v4/{id}/{z}/{x}/{y}.png?access_token={accessToken}',
        {
          attribution:
            'Map data &copy; <a href="http://openstreetmap.org">OpenStreetMap</a> contributors, <a href="http://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="http://mapbox.com">Mapbox</a>',
          maxZoom: 18,
          id: 'mapbox.streets',
          accessToken: config.leafletAccessToken
        }
      ).addTo(this.map);
    },

    addMarker() {
      if (this.location.latitude === null) return;

      this.marker = L.marker([
        this.location.latitude,
        this.location.longitude
      ]).addTo(this.map);
      this.marker.bindPopup('<b>' + this.location.name + '</b>');
    },

    updateMap(event) {
      event.preventDefault();

      axios.get(config.geocoderUrl + this.input).then(response => {
        if (response.data.length === 0) return;

        const newLocation = response.data[0];
        const latLng = { lat: newLocation.lat, lng: newLocation.lon };
        this.location.name = this.input;
        this.location.latitude = latLng.lat;
        this.location.longitude = latLng.lng;

        if (this.marker === null) {
          this.addMarker();
        } else {
          this.marker.setLatLng(latLng);
          this.marker.setPopupContent('<b>' + this.input + '</b>');
        }
        this.map.panTo(latLng);
      });
    }
  },

  created() {
    if (this.defaultLocation) {
      this.location.name = this.defaultLocation.name;
      this.location.latitude = this.defaultLocation.latitude;
      this.location.longitude = this.defaultLocation.longitude;
    }
  },

  mounted() {
    this.initMap();
    this.addMarker();
  }
};
</script>