require('./bootstrap');

// Require Vue
window.Vue = require('vue').default;
import vuetify from './vuetify';
import "@mdi/font/css/materialdesignicons.css"; // Ensure you are using css-loader

require('@coreui/coreui/dist/js/coreui.bundle.min');

//rutas vue
import router from './router';

import VueRouter from 'vue-router'

Vue.use(VueRouter)

import vSelect from "vue-select";

Vue.component('v-select', vSelect)

import PulseLoader from 'vue-spinner/src/PulseLoader.vue'

Vue.component('pulse-loader', PulseLoader);

import InfiniteLoading from 'vue-infinite-loading';

Vue.use(InfiniteLoading, { /* options */ });

import toastr from "toastr";

window.toastr = toastr;

// import plugin
import VueToastr from "vue-toastr";

Vue.use(VueToastr);

// Vue Leaflet (maps)
import {
    LMap,
    LTileLayer,
    LMarker,
    LCircle,
    LCircleMarker,
    LIcon,
    LPopup,
    LTooltip,
    LGeoJson
} from "vue2-leaflet";
import 'leaflet/dist/leaflet.css';
Vue.component('l-map', LMap);
Vue.component('l-tile-layer', LTileLayer);
Vue.component('l-marker', LMarker);
Vue.component('l-circle', LCircle);
Vue.component('l-circle-marker', LCircleMarker);
Vue.component('l-popup', LPopup);
Vue.component('l-tooltip', LTooltip);
Vue.component('l-icon', LIcon);
Vue.component('l-geo-json', LGeoJson);

import VueSweetalert2 from 'vue-sweetalert2';
import VueMask from 'v-mask'

// Las 3 son requeridas para que valide si es requerido y el tipo de campo email
import { ValidationProvider } from 'vee-validate';
import { extend } from 'vee-validate';
import { required, email } from 'vee-validate/dist/rules';

// If you don't need the styles, do not connect
import 'sweetalert2/dist/sweetalert2.min.css';
import 'vue-select/dist/vue-select.css';

// PAQUETES EXTERNOS
Vue.use(VueSweetalert2);
Vue.component('v-select', vSelect)
Vue.use(VueMask);
Vue.component('ValidationProvider', ValidationProvider);

const moment = require('moment/locale/es')
Vue.use(require('vue-moment'), {
    moment
})

// Register Vue Components
Vue.component('content-component', require('./components/ContentComponent.vue').default);
Vue.component('forbidden-component', require('./components/ForbiddenComponent').default);

extend('required', {
    ...required,
    message: 'Este campo es requerido!'
});
// Add the email rule
extend('email', {
    ...email,
    message: 'El correo electrónico no tiene un formato valido.'
});

// Initialize Vue
export const appVue = new Vue({
    el: '#app',
    vuetify,
    router,
    data: {
        show: true,
    },
    icons: {
        iconfont: "mdi", // default - only for display purposes
    },
});

// window.VueRef=appVue.$refs;
