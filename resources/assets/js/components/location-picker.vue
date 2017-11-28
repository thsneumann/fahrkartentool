<template>

<div class="vue-location-picker">
    <div class="form-group d-flex">
      <select :name="field" :id="field" v-model="selected" class="form-control custom-select mr-3">
          <option value="0">Ort auswählen</option>
          <option v-for="location in myLocations" 
            :value="location.id" :key="location.id">{{ location.name }}</option>
      </select>
    </div>
    

    <div class="form-group">
      <a href="#" role="button" class="btn btn-primary mb-3" @click.prevent="toggle">
        <i class="fa fa-plus" aria-hidden="true"></i>
        Ort hinzufügen
      </a>
    </div>

    <div class="picker" :class="{ 'is-visible': isPickerVisible }">
      <div class="form-group">
        <div class="d-flex align-items-center">
            <input type="text" id="name" name="name" class="form-control mr-2"
            v-model="input" 
            @keydown.enter="updateMap">
            <a class="mr-2" href="#" title="Aktualisieren" @click="updateMap">
                <i class="fa fa-refresh" aria-hidden="true"></i>
            </a>
            <a href="#" title="Übernehmen" @click.prevent="applyChanges" v-if="hasEnteredNewLocation">
                <i class="fa fa-check" aria-hidden="true"></i>
            </a>
        </div>
      </div>

      <div :id="field + '_map'" class="map form-group"></div>
    </div>
    
</div>

</template>

<script>
import config from '../config';
import gmapsStyles from '../gmaps-styles';

export default {
  props: {
    field: {
      type: String,
      required: true
    },
    locations: {
      type: Array,
      required: true
    },
    defaultLocationId: {
      type: Number
    }
  },

  data() {
    return {
      myLocations: [],
      location: {
        name: 'Berlin',
        latitude: config.defaultLocation.latitude,
        longitude: config.defaultLocation.longitude
      },
      map: null,
      marker: null,
      infowindow: null,
      input: null,
      isPickerVisible: false,
      hasEnteredNewLocation: false,
      selected: 0
    };
  },

  methods: {
    initMap() {
      this.map = new google.maps.Map(this.$el.querySelector('.map'), {
        styles: gmapsStyles,
        zoom: 7,
        center: {
          lat: this.location.latitude,
          lng: this.location.longitude
        }
      });
    },

    addMarker() {
      this.marker = new google.maps.Marker({
        position: { lat: this.location.latitude, lng: this.location.longitude },
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
        this.marker.setPosition(latLng);
        this.infowindow.setContent('<b>' + this.input + '</b>');
        this.map.panTo(latLng);

        this.location.name = this.input;
        this.location.latitude = latLng.lat;
        this.location.longitude = latLng.lng;

        this.hasEnteredNewLocation = true;
      });
    },

    applyChanges() {
      axios
        .post('/api/locations', {
          name: this.location.name,
          latitude: this.location.latitude,
          longitude: this.location.longitude
        })
        .then(response => {
          console.log(response.data.id);
          const newLocation = response.data;
          this.myLocations.push(newLocation);
          this.selected = newLocation.id;
          this.isPickerVisible = false;
        })
        .catch(error => {
          console.log(error);
        });
    },

    toggle() {
      this.isPickerVisible = !this.isPickerVisible;
    }
  },

  created() {
    this.myLocations.splice(0, ...this.locations);
    this.selected = this.defaultLocationId;
  },

  mounted() {
    EventBus.$on('google-maps-loaded', () => {
      this.initMap();
      this.addMarker();
    });
  }
};
</script>