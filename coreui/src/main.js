import 'core-js/stable'
import Vue from 'vue'
import App from './App'
import router from './router'
import CoreuiVue from '@coreui/vue'
import { iconsSet as icons } from './assets/icons/icons.js'
import store from './store'
import "font-awesome/css/font-awesome.min.css";
import VueWow from 'vue-wow'

import {
  What3wordsAutosuggest,
  What3wordsMap,
} from "@what3words/vue-components";

Vue.use(VueWow)
Vue.component('VueFontawesome', require('vue-fontawesome-icon/VueFontawesome.vue').default);
import VueDatetimePickerJs from 'vue-date-time-picker-js';
Vue.component('date-picker', VueDatetimePickerJs);
Vue.prototype.$apiAdress = 'http://127.0.0.1:8000'
Vue.config.performance = true
Vue.use(CoreuiVue)
import VueToast from 'vue-toast-notification';
import 'vue-toast-notification/dist/theme-sugar.css';
Vue.use(VueToast);
import FlashMessage from '@smartweb/vue-flash-message';
Vue.use(FlashMessage);
import middleware from "@grafikri/vue-middleware"
router.beforeEach(middleware({ store }))
import * as VueGoogleMaps from "vue2-google-maps";
Vue.use(VueGoogleMaps, {
  load: {
    key: 'AIzaSyAONdWlvzm8Jc8elwxfe4_hQwcjZDnAH38',//'AIzaSyCQFgtBkcBv1d2JFCOEkho4bwXTlhOQDx4', //AIzaSyAONdWlvzm8Jc8elwxfe4_hQwcjZDnAH38
    libraries: "places",
    componentRestrictions: { country: 'IN' }
  }
});

new Vue({
  el: '#app',
  router,
  store,   
  icons,
  template: '<App/>',
  components: {
    App,
    What3wordsAutosuggest,
    What3wordsMap
  },
})
