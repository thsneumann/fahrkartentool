<template>

<div class="vue-ticket-locations-picker">
    <div class="row">
      <div class="col">
        <div class="d-flex align-items-end mr-5">
          <div class="form-group mr-2">
            <label for="point_of_departure_name" class="mr-2">Abfahrtsort:</label>
            <input id="point_of_departure_name" name="point_of_departure_name" class="form-control"
                  v-model="pointOfDeparture.name" 
                  @keydown.enter="updateMap('pointOfDeparture', $event)">

            <input type="hidden" id="point_of_departure_latitude" name="point_of_departure_latitude" :value="pointOfDeparture.latitude">
            <input type="hidden" id="point_of_departure_longitude" name="point_of_departure_longitude" :value="pointOfDeparture.longitude">
          </div>
          <div class="form-group">
            <a class="btn btn-primary mr-2" href="#" title="Aktualisieren" @click="updateMap('pointOfDeparture', $event)">
                <i class="fa fa-refresh" aria-hidden="true"></i>
                Karte aktualisieren
            </a>
          </div>
        </div>
      </div>
      <div class="col">
        <div class="d-flex align-items-end">
          <div class="form-group mr-2">
            <label for="destination_name" class="mr-2">Zielort:</label>
            <input id="destination_name" name="destination_name" class="form-control"
                  v-model="destination.name" 
                  @keydown.enter="updateMap('destination', $event)">

            <input type="hidden" id="destination_latitude" name="destination_latitude" :value="destination.latitude">
            <input type="hidden" id="destination_longitude" name="destination_longitude" :value="destination.longitude">
          </div>
          <div class="form-group">
            <a class="btn btn-primary mr-2" href="#" title="Aktualisieren" @click="updateMap('destination', $event)">
                <i class="fa fa-refresh" aria-hidden="true"></i>
                Karte aktualisieren
            </a>
          </div>
        </div>
      </div>
    </div>

    <div class="map form-group"></div>
</div>

</template>

<script>
import config from '../config';
import gmapsStyles from '../gmaps-styles';

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
        latitude: null,
        longitude: null,
        marker: null,
        infowindow: null
      },
      destination: {
        name: null,
        latitude: null,
        longitude: null,
        marker: null,
        infowindow: null
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
    initMap() {
      let center;
      if (this.pointOfDeparture.latitude && this.pointOfDeparture.longitude) {
        center = {
          lat: this.pointOfDeparture.latitude,
          lng: this.pointOfDeparture.longitude
        };
      } else {
        center = {
          lat: config.defaultLocation.latitude,
          lng: config.defaultLocation.longitude
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
        position: { lat: location.latitude, lng: location.longitude },
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

    updateMap(field, event) {
      event.preventDefault();

      const location = this[field];

      axios.get(config.geocoderUrl + location.name).then(response => {
        if (response.data.length === 0) return;

        const newLocation = response.data[0];
        const latLng = { lat: +newLocation.lat, lng: +newLocation.lon };

        location.latitude = latLng.lat;
        location.longitude = latLng.lng;

        if (location.marker) {
          location.marker.setPosition(latLng);
        } else {
          this.addMarker(location);
        }
        location.infowindow.setContent('<b>' + location.name + '</b>');

        this.updateConnectingLine();

        this.map.panTo(latLng);
      });
    },

    updateConnectingLine() {
      if (this.connection === null) return;

      if (this.connectingLine) this.connectingLine.setMap(null);

      this.connectingLine = new google.maps.Polyline({
        path: [
          {
            lat: this.connection.from.latitude,
            lng: this.connection.from.longitude
          },
          {
            lat: this.connection.to.latitude,
            lng: this.connection.to.longitude
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
      this.pointOfDeparture.latitude = this.defaultPointOfDeparture.latitude;
      this.pointOfDeparture.longitude = this.defaultPointOfDeparture.longitude;
    }
    if (this.defaultDestination) {
      this.destination.name = this.defaultDestination.name;
      this.destination.latitude = this.defaultDestination.latitude;
      this.destination.longitude = this.defaultDestination.longitude;
    }
  },

  mounted() {
    EventBus.$on('google-maps-loaded', () => {
      this.initMap();
      if (this.pointOfDeparture.latitude) this.addMarker(this.pointOfDeparture);
      if (this.destination.latitude) this.addMarker(this.destination);
      this.updateConnectingLine();
    });
  }
};
</script>