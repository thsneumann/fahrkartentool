require('./bootstrap');

window.Vue = require('vue');

Vue.component('explorer-map', require('./components/explorer-map.vue'));
Vue.component('location-editor', require('./components/location-editor.vue'));
Vue.component('location-picker', require('./components/location-picker.vue'));
Vue.component('rotating-globe', require('./components/rotating-globe.vue'));

const app = new Vue({
  el: '#app',
  mounted() {
    console.log('Vue is ready.');
  }
});
