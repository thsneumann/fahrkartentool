<template>
    <div id="explorer-map" class="map"></div>
</template>

<script>
import config from '../config';
import gmapsStyles from '../gmaps-styles.json';
import '../vendor/markerclusterer';

export default {
  data() {
    return {
      map: null,
      connectingLines: null,
      infowindow: null,
      lineSymbol: null
    };
  },

  methods: {
    initMap() {
      this.map = new google.maps.Map(this.$el, {
        styles: gmapsStyles,
        zoom: 7,
        center: {
          lat: config.defaultLocation.lat,
          lng: config.defaultLocation.lng
        }
      });

      // add location markers
      axios
        .get('/api/locations/')
        .then(this.addMarkers)
        .catch(error => {
          console.error(error);
        });

      // define arrow symbol
      this.lineSymbol = {
        path: google.maps.SymbolPath.FORWARD_CLOSED_ARROW
      };
    },

    addMarkers(locations) {
      const markers = [];

      locations.data.forEach(location => {
        var marker = new google.maps.Marker({
          position: { lat: location.lat, lng: location.lng },
          map: this.map,
          icon: config.markerIcon
        });
        marker.addListener('click', () => {
          this.showLocationInfo(marker, location);
        });
        markers.push(marker);
      });

      const options = {
        imagePath: 'img/m',
        minimumClusterSize: 10
      };

      const markerClusterer = new MarkerClusterer(this.map, markers, options);
    },

    showLocationInfo(marker, location) {
      axios
        .get('/locations/' + location.id + '/popup')
        .then(response => {
          if (this.infowindow) this.infowindow.close();

          this.infowindow = new google.maps.InfoWindow({
            content: response.data
          });
          this.infowindow.open(this.map, marker);
        })
        .catch(error => {
          console.error(error);
        });

      axios
        .get('/api/locations/' + location.id + '/outgoing')
        .then(destinations => {
          this.clearConnectingLines();
          this.connectingLines = destinations.data.map(destination => {
            return this.createConnectingLine(location, destination);
          });
        })
        .then(() => {
          axios
            .get('/api/locations/' + location.id + '/incoming')
            .then(pointsOfDeparture => {
              this.connectingLines.push(
                ...pointsOfDeparture.data.map(origin => {
                  return this.createConnectingLine(origin, location);
                })
              );
            });
        });
    },

    createConnectingLine(location, destination) {
      return new google.maps.Polyline({
        path: [
          { lat: location.lat, lng: location.lng },
          { lat: destination.lat, lng: destination.lng }
        ],
        icons: [
          {
            icon: this.lineSymbol,
            offset: '100%'
          }
        ],
        map: this.map
      });
    },

    clearConnectingLines() {
      if (this.connectingLines === null) {
        this.connectingLines = [];
      } else {
        this.connectingLines.forEach(line => {
          line.setMap(null);
        });
      }
    }
  },
  mounted() {
    EventBus.$on('google-maps-loaded', this.initMap);
  }
};
</script>