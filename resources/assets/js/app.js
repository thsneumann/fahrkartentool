require('./bootstrap');

window.EventBus = new Vue();

Vue.component('explorer-map', require('./components/explorer-map.vue'));
Vue.component('location-editor', require('./components/location-editor.vue'));
Vue.component('location-picker', require('./components/location-picker.vue'));
Vue.component(
  'ticket-locations-picker',
  require('./components/ticket-locations-picker.vue')
);
Vue.component('rotating-globe', require('./components/rotating-globe.vue'));

const app = new Vue({
  el: '#app'
});

window.initMap = () => {
  EventBus.$emit('google-maps-loaded');
};

// Home page animation
import HomeAnimation from './modules/home-animation';

// if (document.body.classList.contains('homepage')) HomeAnimation.run();
