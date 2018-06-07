<template>

<div class="vue-location-editor">
    <div class="picker">
      <div class="form-group pos-rel">
        <div class="d-flex align-items-center">
            <input type="text" id="name" name="name" :value="location.name" 
            class="form-control mr-2"
            autocomplete="off"
            v-model.trim="location.name" 
            @input="updateInput"
            @keydown.enter.prevent>
        </div>

        <ul class="geocoder-result-list">
          <li v-for="locationData in location.geocoderResults" @click="select(locationData)">
            {{ locationData.display_name }}
          </li>
        </ul>

        <p class="pl-1 mt-1 text-small">{{ location.longname }}</p>
      </div>

      <div id="vue-location-editor-map" class="map form-group"></div>
    </div>

    <input type="hidden" id="longname" name="longname" :value="location.longname">
    <input type="hidden" id="lat" name="lat" :value="location.lat">
    <input type="hidden" id="lng" name="lng" :value="location.lng">
</div>

</template>

<script>
import debounce from 'lodash.debounce';
import config from '../config';
import gmapsStyles from '../gmaps-styles.json';

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
        longname: null,
        lat: null,
        lng: null,
        geocoderResults: []
      },
      map: null,
      marker: null,
      infowindow: null
    };
  },

  methods: {
    select(locationData) {
      this.location.longname = locationData.display_name;
      this.location.lat = +locationData.lat;
      this.location.lng = +locationData.lon;
      this.location.geocoderResults = [];

      this.updateMap();
    },

    updateInput: debounce(function() {
      if (this.location.name === '') return;

      axios.get(config.geocoderUrl + this.location.name).then(response => {
        if (response.data.length === 0) return;

        console.log(response.data);

        this.location.geocoderResults = response.data.slice(0, 5);
      });
    }, 300),

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

    updateMap() {
      const latLng = { lat: this.location.lat, lng: this.location.lng };

      if (this.marker === null) {
        this.addMarker();
      } else {
        this.marker.setPosition(latLng);
        this.infowindow.setContent('<b>' + this.location.name + '</b>');
      }
      this.map.panTo(latLng);
    }
  },

  created() {
    if (this.defaultLocation) {
      this.location.name = this.defaultLocation.name;
      this.location.longname = this.defaultLocation.longname;
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