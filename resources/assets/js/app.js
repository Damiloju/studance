/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */
import './bootstrap';
import Vue from 'vue';
import Notifications from 'vue-notification'
import velocity from 'velocity-animate'

window.Vue = Vue;

Vue.use(Notifications, {velocity});

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('home-component', require('./views/Home.vue'));
Vue.component('login-component', require('./views/Login.vue'));
Vue.component('student-registration-component', require('./views/Register.vue'));
Vue.component('dashboard-component', require('./components/Dashboard.vue'));
Vue.component('students-component', require('./components/Students.vue'));
Vue.component('records-component', require('./components/Records.vue'));
Vue.component('individual-records-component', require('./components/IndividulRecords.vue'));

Vue.component('app-loading',		require('./misc/AppLoader.vue'));
Vue.component('btn-loading',		require('./misc/ButtonLoader.vue'));

const app = new Vue({
    el: '#app'
});
