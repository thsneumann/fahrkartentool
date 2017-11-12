<template>
    <div id="explorer-map" class="map"></div>
</template>

<script>
import config from '../config';

export default {
  data() {
    return {
      map: null,
      accessToken: config.leafletAccessToken,
      connectingLines: []
    };
  },

  methods: {
    initMap() {
      this.map = L.map("explorer-map").setView([config.mapCenter.lat, config.mapCenter.lng], 7);
      L.tileLayer(
        "https://api.tiles.mapbox.com/v4/{id}/{z}/{x}/{y}.png?access_token={accessToken}",
        {
          attribution:
            'Map data &copy; <a href="http://openstreetmap.org">OpenStreetMap</a> contributors, <a href="http://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="http://mapbox.com">Mapbox</a>',
          maxZoom: 18,
          id: "mapbox.streets",
          accessToken: this.accessToken
        }
      ).addTo(this.map);
    },

    addMarkers(response) {
      response.data.forEach(location => {
        var marker = L.marker([location.latitude, location.longitude]).addTo(
          this.map
        );
        marker.on("click", () => {
          this.showLocationInfo(marker, location);
        });
      });
    },

    drawConnection(marker, origin, destination) {
      return L.polylineDecorator([origin, destination], {
        patterns: [
          {
            offset: 0,
            repeat: 10,
            symbol: L.Symbol.dash({
              pixelSize: 5,
              pathOptions: { color: "#000", weight: 1, opacity: 0.8 }
            })
          },
          {
            offset: "16%",
            repeat: "33%",
            symbol: L.Symbol.marker({
              rotate: true,
              markerOptions: {
                icon: L.icon({
                  iconUrl: "/img/icon_train.png",
                  iconAnchor: [20, 12]
                })
              }
            })
          }
        ]
      }).addTo(this.map);
    },

    showLocationInfo(marker, location) {
      axios
        .get("/locations/" + location.id + "/popup")
        .then(response => {
          marker.bindPopup(response.data).openPopup();
        })
        .catch(error => {
          console.error(error);
        });
      axios
        .get("/api/locations/" + location.id + "/outgoing")
        .then(connections => {
          this.connectingLines.forEach(line => {
            line.remove();
          });
          this.connectingLines = connections.data.map(connection =>
            this.drawConnection(marker, marker.getLatLng(), connection)
          );
        });
    }
  },
  mounted() {
    this.initMap();
    axios
      .get("/api/locations/")
      .then(this.addMarkers)
      .catch(error => {
        console.error(error);
      });
  }
};
</script>