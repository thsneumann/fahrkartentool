
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

/* window.Vue = require('vue');

const app = new Vue({
    el: '#app',
    mounted() {
        console.log('Vue is ready.');
    }
}); */

import RotatingGlobe from './modules/rotating-globe';

const globe = $('#globe');
if (globe.length) {
    RotatingGlobe.run();
    globe.removeClass('zoomed');
    $('#home-nav').addClass('fade-in');
}
