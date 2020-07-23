

require('./bootstrap');

window.Vue = require('vue');
import Vue from 'vue'
import Vuetify from 'vuetify'
import VueScheduler from 'v-calendar-scheduler';
import Notifications from 'vue-notification'
import EventBus from './EventBus'

import moment from 'moment'
import 'v-calendar-scheduler/lib/main.css';


import swal from 'sweetalert2';
window.swal = swal;

import VueCtkDateTimePicker from 'vue-ctk-date-time-picker';
import 'vue-ctk-date-time-picker/dist/vue-ctk-date-time-picker.css';



Vue.use(Vuetify)
Vue.use(Notifications)
Vue.use(VueScheduler,{locale: 'es',
labels: {
    today: 'Hoy',
    back: 'Atrás',
    next: 'Siguiente',
    month: 'Mes',
    week: 'Semana',
    day: 'Día',
    all_day: 'Todo el día'
 },
 initialDate: new Date()
})

import User from './Helpers/User'
window.User = User
Vue.prototype.$bus = EventBus
Vue.prototype.moment = moment

Vue.component('cotizacion-component', require('./components/CotizacionComponent.vue').default);
Vue.component('categoria-component', require('./components/categoriaComponent.vue').default);
// Vue.component('producto-component', require('./components/ProductoComponent.vue').default);
Vue.component('proveedor-component', require('./components/ProveedorComponent.vue').default);
Vue.component('cliente-component', require('./components/ClienteComponent.vue').default);
Vue.component('rol-component', require('./components/RolComponent.vue').default);
Vue.component('user-component', require('./components/UserComponent.vue').default);
Vue.component('taller-component', require('./components/tallerComponent.vue').default);
Vue.component('arbol-component', require('./components/ArbolComponent.vue').default);
Vue.component('talleruser-component', require('./components/TallerUserComponent.vue').default);
Vue.component('vehiculo-component', require('./components/VehiculoComponent.vue').default);
Vue.component('reparacion-component', require('./components/ReparacionComponent.vue').default);
Vue.component('historial-component', require('./components/HistorialComponent.vue').default);
Vue.component('historialcliente-component', require('./components/HistorialClienteComponent.vue').default);
Vue.component('historialcotizaciones-component', require('./components/HistorialCotizacionesComponent.vue').default);
Vue.component('historialclientecotizaciones-component', require('./components/HistorialCotizacionesClienteComponent.vue').default);

Vue.component('VueCtkDateTimePicker', VueCtkDateTimePicker);

Vue.component('new-arrivals', require('./components/NewArrivals.vue').default);

const app = new Vue({
    el: '#app',
    data:{
        menu:0,
    },
});
