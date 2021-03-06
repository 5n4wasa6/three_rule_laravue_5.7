
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

import Vue from 'vue';
import App from './App.vue';
import axios  from 'axios'
import VueAxios  from 'vue-axios'
import VueProgressiveImage from 'vue-progressive-image';
import { sync } from 'vuex-router-sync';
import store from './store/index';
import router from './router/index';
import fullCalendar from 'vue-fullcalendar';

Vue.component('full-calendar', fullCalendar)

Vue.use(VueAxios, axios); 
sync(store, router);

Vue.use(VueProgressiveImage, {
  blur: 30
})

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
  router,
  store,
  render: h => h(App)
}).$mount('#app');
