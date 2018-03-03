<template>

<div class="vue-ticket-locations-picker">
  <div class="d-flex">
    <div class="d-flex align-items-end">
      <div class="form-group pos-rel mr-2">
        <label for="point_of_departure_name" class="mr-2">Abfahrtsort:</label>
        <input id="point_of_departure_name" name="point_of_departure_name" class="form-control"
              v-model.trim="pointOfDeparture.name" 
              @input="updateInput(pointOfDeparture)">

        <input type="hidden" id="point_of_departure_longname" name="point_of_departure_longname" :value="pointOfDeparture.longname">
        <input type="hidden" id="point_of_departure_lat" name="point_of_departure_lat" :value="pointOfDeparture.lat">
        <input type="hidden" id="point_of_departure_lng" name="point_of_departure_lng" :value="pointOfDeparture.lng">

        <ul class="geocoder-result-list">
          <li v-for="locationData in pointOfDeparture.geocoderResults" @click="select(locationData, pointOfDeparture)">
            {{ locationData.display_name }}
          </li>
        </ul>
      </div>
    </div>

    <div class="d-flex align-items-end">
      <div class="form-group pos-rel mr-2">
        <label for="destination_name" class="mr-2">Zielort:</label>
        <input id="destination_name" name="destination_name" class="form-control"
              v-model.trim="destination.name" 
              @input="updateInput(destination)">

        <input type="hidden" id="destination_longname" name="destination_longname" :value="destination.longname">
        <input type="hidden" id="destination_lat" name="destination_lat" :value="destination.lat">
        <input type="hidden" id="destination_lng" name="destination_lng" :value="destination.lng">

        <ul class="geocoder-result-list">
          <li v-for="location in destination.geocoderResults" @click="select(location, destination)">
            {{ location.display_name }}
          </li>
        </ul>
      </div>
    </div>
  </div>

  <div class="map form-group"></div>
</div>

</template>

<script>
import debounce from 'lodash.debounce';
import config from '../config';
import gmapsStyles from '../gmaps-styles.json';

export default {
  props: {
    defaultPointOfDeparture: {
      type: Object
    },
    defaultDestination: {
      type: Object
    }
  },

  data() {
    return {
      pointOfDeparture: {
        name: null,
        longname: null,
        lat: null,
        lng: null,
        marker: null,
        infowindow: null,
        geocoderResults: []
      },
      destination: {
        name: null,
        lat: null,
        lng: null,
        marker: null,
        infowindow: null,
        geocoderResults: []
      },
      lineSymbol: null,
      connectingLine: null
    };
  },

  computed: {
    connection() {
      if (
        this.pointOfDeparture.marker === null ||
        this.destination.marker === null
      )
        return null;

      return {
        from: this.pointOfDeparture,
        to: this.destination
      };
    }
  },

  methods: {
    select(locationData, location) {
      location.longname = locationData.display_name;
      location.lat = +locationData.lat;
      location.lng = +locationData.lon;
      location.geocoderResults = [];

      this.updateMap(location);
    },

    updateInput: debounce(function(location) {
      if (location.name === '') return;

      axios.get(config.geocoderUrl + location.name).then(response => {
        if (response.data.length === 0) return;

        location.geocoderResults = response.data.slice(0, 5);
      });
    }, 300),

    initMap() {
      let center;
      if (this.pointOfDeparture.lat && this.pointOfDeparture.lng) {
        center = {
          lat: this.pointOfDeparture.lat,
          lng: this.pointOfDeparture.lng
        };
      } else {
        center = {
          lat: config.defaultLocation.lat,
          lng: config.defaultLocation.lng
        };
      }

      this.map = new google.maps.Map(this.$el.querySelector('.map'), {
        styles: gmapsStyles,
        zoom: 5,
        center
      });

      // define arrow symbol
      this.lineSymbol = {
        path: google.maps.SymbolPath.FORWARD_CLOSED_ARROW
      };
    },

    addMarker(location) {
      location.marker = new google.maps.Marker({
        position: { lat: location.lat, lng: location.lng },
        map: this.map,
        icon: config.markerIcon
      });

      location.infowindow = new google.maps.InfoWindow({
        content: '<b>' + location.name + '</b>'
      });

      location.marker.addListener('click', () => {
        location.infowindow.open(this.map, location.marker);
      });
    },

    updateMap(location) {
      const latLng = {
        lat: location.lat,
        lng: location.lng
      };

      if (location.marker) {
        location.marker.setPosition(latLng);
      } else {
        this.addMarker(location);
      }
      location.infowindow.setContent('<b>' + location.name + '</b>');

      this.updateConnectingLine();

      this.map.panTo(latLng);
    },

    updateConnectingLine() {
      if (this.connection === null) return;

      if (this.connectingLine) this.connectingLine.setMap(null);

      this.connectingLine = new google.maps.Polyline({
        path: [
          {
            lat: this.connection.from.lat,
            lng: this.connection.from.lng
          },
          {
            lat: this.connection.to.lat,
            lng: this.connection.to.lng
          }
        ],
        icons: [
          {
            icon: this.lineSymbol,
            offset: '100%'
          }
        ],
        map: this.map
      });
    }
  },

  created() {
    if (this.defaultPointOfDeparture) {
      this.pointOfDeparture.name = this.defaultPointOfDeparture.name;
      this.pointOfDeparture.lat = this.defaultPointOfDeparture.lat;
      this.pointOfDeparture.lng = this.defaultPointOfDeparture.lng;
    }
    if (this.defaultDestination) {
      this.destination.name = this.defaultDestination.name;
      this.destination.lat = this.defaultDestination.lat;
      this.destination.lng = this.defaultDestination.lng;
    }
  },

  mounted() {
    EventBus.$on('google-maps-loaded', () => {
      this.initMap();
      if (this.pointOfDeparture.lat) this.addMarker(this.pointOfDeparture);
      if (this.destination.lat) this.addMarker(this.destination);
      this.updateConnectingLine();
    });
  }
};
</script>