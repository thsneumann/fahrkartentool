<template>

<div class="vue-location-editor">
    <div class="picker">
      <div class="form-group">
        <div class="d-flex align-items-center">
            <input type="text" id="name" name="name" :value="location.name" class="form-control mr-2"
            v-model="input" 
            @keydown.enter="updateMap">
            <a class="btn btn-primary mr-2" href="#" title="Aktualisieren" @click="updateMap">
                <i class="fa fa-refresh" aria-hidden="true"></i>
                Karte aktualisieren
            </a>
        </div>
      </div>

      <div id="vue-location-editor-map" class="map form-group"></div>
    </div>

    <input type="hidden" id="lat" name="lat" :value="location.lat">
    <input type="hidden" id="lng" name="lng" :value="location.lng">
</div>

</template>

<script>
import config from '../config';
import gmapsStyles from '../gmaps-styles';

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
        lat: null,
        lng: null
      },
      map: null,
      marker: null,
      infowindow: null,
      input: this.defaultLocation && this.defaultLocation.name
    };
  },

  methods: {
    initMap() {
      this.map = new google.maps.Map(this.$el.querySelector('.map'), {
        styles: gmapsStyles,
        zoom: 7,
        center: {
          lat: this.location.lat || config.defaultLocation.lat,
          lng: this.location.lng || config.defaultLocation.lng
        }
      });
    },

    addMarker() {
      if (this.location.lat === null) return;

      this.marker = new google.maps.Marker({
        position: { lat: this.location.lat, lng: this.location.lng },
        map: this.map,
        icon: config.markerIcon
      });

      this.infowindow = new google.maps.InfoWindow({
        content: '<b>' + this.location.name + '</b>'
      });

      this.marker.addListener('click', () => {
        this.infowindow.open(this.map, this.marker);
      });
    },

    updateMap(event) {
      event.preventDefault();

      axios.get(config.geocoderUrl + this.input).then(response => {
        if (response.data.length === 0) return;

        const newLocation = response.data[0];
        const latLng = { lat: +newLocation.lat, lng: +newLocation.lon };
        this.location.name = this.input;
        this.location.lat = latLng.lat;
        this.location.lng = latLng.lng;

        if (this.marker === null) {
          this.addMarker();
        } else {
          this.marker.setPosition(latLng);
          this.infowindow.setContent('<b>' + this.input + '</b>');
        }
        this.map.panTo(latLng);
      });
    }
  },

  created() {
    if (this.defaultLocation) {
      this.location.name = this.defaultLocation.name;
      this.location.lat = this.defaultLocation.lat;
      this.location.lng = this.defaultLocation.lng;
    }
  },

  mounted() {
    EventBus.$on('google-maps-loaded', () => {
      this.initMap();
      this.addMarker();
    });
  }
};
</script>