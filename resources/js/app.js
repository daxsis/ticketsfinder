require('./bootstrap');

import Vue from 'vue'
import BootstrapVue from 'bootstrap-vue'
import App from './App.vue'
import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'

Vue.use(BootstrapVue)
Vue.component('pagination', require('laravel-vue-pagination'));

new Vue({ el: '#app', render: h => h(App) })
