require('./bootstrap');
import ExplorerMap from './components/explorer-map.vue';
import LocationEditor from './components/location-editor.vue';
import TicketLocationsTicker from './components/ticket-locations-picker.vue';

window.EventBus = new Vue();

Vue.component('explorer-map', ExplorerMap);
Vue.component('location-editor', LocationEditor);
Vue.component('ticket-locations-picker', TicketLocationsTicker);

const app = new Vue({
  el: '#app'
});

window.initMap = () => {
  EventBus.$emit('google-maps-loaded');
};

require('./modules/set-min-date');
require('./modules/fancybox-video');
