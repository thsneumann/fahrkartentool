<template>

<div class="vue-ticket-locations-picker">
    <p><em>Bitte tragen Sie Abfahrts- und Zielort sowie gegebenenfalls Zwischenstationen ein.</em></p>
    
    <div :key="i" class="d-flex align-items-end" v-for="(location, i) in locations">
      <div class="form-group pos-rel mr-2">
        <div class="d-flex align-items-center">
          <i class="fa fa-map-marker mr-2"></i>
          <input :id="getId(i, 'name')" class="form-control mr-2"
              autocomplete="off"
              v-model.trim="location.name" 
              @input="updateInput(location)"
              :placeholder="getInputPlaceholder(i)">
          <a href="#" class="mr-2" @click.prevent="moveUp(i)">
            <i class="fa fa-angle-up"></i>
          </a>
          <a href="#" class="mr-2" @click.prevent="moveDown(i)">
            <i class="fa fa-angle-down"></i>
          </a>
          <a href="#" @click.prevent="remove(i)">
            <i class="fa fa-trash"></i>
          </a>
        </div>

        <ul class="geocoder-result-list">
          <li :key="i" v-for="(locationData, i) in location.geocoderResults" @click="select(locationData, location)">
            {{ locationData.display_name }}
          </li>
        </ul>
      </div>
    </div>

    <input type="hidden" id="locations" name="locations" :value="locationsFieldValue">

    <div class="d-flex align-items-center mb-4">
      <a href="#" @click.prevent="addLocation">
        <i class="fa fa-plus-circle mr-2"></i>
        Station hinzufügen
      </a>
    </div>

  <div class="map form-group"></div>
</div>

</template>

<script>
import debounce from 'lodash.debounce';
import config from '../config';
import gmapsStyles from '../gmaps-styles.json';

const emptyLocation = {
  id: null,
  name: null,
  longname: null,
  lat: null,
  lng: null,
  geocoderResults: []
};

export default {
  props: {
    defaultLocations: {
      type: Array
    }
  },

  data() {
    return {
      isMapLoaded: false,
      locations: [],
      realLocations: [],
      lineSymbol: null,
      connectingLines: []
    };
  },

  computed: {
    locationsFieldValue() {
      const locations = this.locations.filter(l => l.lat !== null).map(l => ({
        id: l.id,
        name: l.name,
        longname: l.longname,
        lat: l.lat,
        lng: l.lng
      }));

      return JSON.stringify(locations);
    }
  },

  watch: {
    locations() {
      if (!this.isMapLoaded) return;

      this.updateConnectingLines();
      this.fitMapBounds();
    }
  },

  methods: {
    getId(i, name) {
      return 'location-' + i + '_' + name;
    },

    getInputPlaceholder(i) {
      if (i === 0) return 'Abfahrtsort';
      if (i === this.locations.length - 1) return 'Zielort';

      return 'Zwischenstation';
    },

    addLocation() {
      if (this.locations.length <= 1) {
        this.locations.push(Object.assign({}, emptyLocation));
      } else {
        this.locations.splice(
          this.locations.length - 1,
          0,
          Object.assign({}, emptyLocation)
        );
      }
    },

    getNonEmptyLocations() {
      return this.locations.filter(location => location.lat !== null);
    },

    moveUp(i) {
      if (i === 0) return;

      this.locations.splice(i - 1, 0, this.locations.splice(i, 1)[0]);
    },

    moveDown(i) {
      if (i === this.locations.length - 1) return;

      this.locations.splice(i + 1, 0, this.locations.splice(i, 1)[0]);
    },

    remove(i) {
      if (this.locations[i].marker) this.locations[i].marker.setMap(null);
      this.locations.splice(i, 1);
    },

    select(locationData, location) {
      location.id = null;
      location.longname = locationData.display_name;
      location.lat = +locationData.lat;
      location.lng = +locationData.lon;
      location.geocoderResults = [];

      this.updateMap(location);
      this.updateConnectingLines();
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
      const locations = this.getNonEmptyLocations(this.locations);
      if (locations.length > 0) {
        center = {
          lat: this.locations[0].lat,
          lng: this.locations[0].lng
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
        maxZoom: 13,
        center
      });

      // define arrow symbol
      this.lineSymbol = {
        path: google.maps.SymbolPath.FORWARD_CLOSED_ARROW
      };

      this.isMapLoaded = true;
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

      // this.map.panTo(latLng);
      this.fitMapBounds();
    },

    fitMapBounds() {
      const locations = this.getNonEmptyLocations();
      if (locations.length === 0) {
        this.setDefaultView();
        return;
      }

      const bounds = new google.maps.LatLngBounds();
      locations.forEach(location => {
        bounds.extend(location);
      });
      this.map.fitBounds(bounds);
    },

    setDefaultView() {
      this.map.setZoom(5);
    },

    updateConnectingLines() {
      this.connectingLines.forEach(line => {
        line.setMap(null);
      });
      this.connectingLines = [];

      const locations = this.getNonEmptyLocations();
      if (locations.length <= 1) return;

      let i = 0;
      do {
        this.connectingLines.push(
          new google.maps.Polyline({
            path: [
              {
                lat: locations[i].lat,
                lng: locations[i].lng
              },
              {
                lat: locations[i + 1].lat,
                lng: locations[i + 1].lng
              }
            ],
            icons: [
              {
                icon: this.lineSymbol,
                offset: '100%'
              }
            ],
            map: this.map
          })
        );
        i += 1;
      } while (i < locations.length - 1);
    }
  },

  created() {
    if (this.defaultLocations.length > 0) {
      this.locations = this.defaultLocations.slice(0);
    } else {
      this.locations.push(
        Object.assign({}, emptyLocation),
        Object.assign({}, emptyLocation)
      );
    }
  },

  mounted() {
    EventBus.$on('google-maps-loaded', () => {
      this.initMap();
      const locations = this.getNonEmptyLocations();
      locations.forEach(location => {
        this.addMarker(location);
      });
      this.updateConnectingLines();
      this.fitMapBounds();
    });
  }
};
</script>