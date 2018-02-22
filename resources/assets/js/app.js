
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

// Vue.component('example-component', require('./components/ExampleComponent.vue'));
// Vue.component('daftarmenu-table', require('./components/daftarmenu/Table.vue'));

// const app = new Vue({
//     el: '#app'
// });

// Vue.component('usermodal', require('./components/user/modal.vue'));
// var usermodal = require('./components/user/_modal.vue');
var modal = require('vue-strap').modal;

import VueRouter from 'vue-router';
Vue.use(VueRouter);

import VueSweetalert2 from 'vue-sweetalert2';
Vue.use(VueSweetalert2);

import vSelect from 'vue-select';
Vue.component('v-select', vSelect);
// var select2 = require('./components/base/select2.vue');

import Autocomplete from 'v-autocomplete';
import css from 'v-autocomplete/dist/v-autocomplete.css';
Vue.use(Autocomplete);


const routes = [
{
  path: '/user',
  name: 'userIndex',
  component: require('./components/user/index.vue')
},
{
  path: '/user/create',
  name: 'userCreate',
  component: require('./components/user/_create.vue') 
},
{
  path: '/user/view/:id_user',
  name: 'userView',
  component: require('./components/user/view.vue')
},
{
  path: '/daftarmenu',
  name: 'daftarMenuIndex',
  component: require('./components/daftarmenu/index.vue')
},
{
  path: '/daftarmenu/create',
  name: 'daftarMenuCreate',
  component: require('./components/daftarmenu/_create.vue') 
},
{
  path: '/daftarmenu/view/:id_menu',
  name: 'daftarMenuView',
  component: require('./components/daftarmenu/view.vue')
},
{
  path: '/pemesanan',
  name: 'pemesananIndex',
  component: require('./components/pemesanan/index.vue')
},
{
  path: '/pemesanan/create',
  name: 'pemesananCreate',
  component: require('./components/pemesanan/create.vue') 
},
]




const router = new VueRouter({ 
                              routes,
                              mode: 'history'
                            });
const app = new Vue({
  router
}).$mount('#app');
