require('./bootstrap');

window.EventBus = new Vue();

Vue.component('explorer-map', require('./components/explorer-map.vue'));
Vue.component('location-editor', require('./components/location-editor.vue'));
Vue.component(
  'ticket-locations-picker',
  require('./components/ticket-locations-picker.vue')
);

const app = new Vue({
  el: '#app'
});

window.initMap = () => {
  EventBus.$emit('google-maps-loaded');
};