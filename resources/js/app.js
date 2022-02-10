/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('boats', require('./components/Boats.vue').default);
Vue.component('jobs', require('./components/Jobs.vue').default);
Vue.component('periodics', require('./components/Periodics.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
});


$('#user').click(function(e) {
    e.preventDefault();
    $('#user-menu').slideToggle(200);
    $(this).toggleClass('active');
});

$('#close-user-menu').click(function(e) {
    e.preventDefault();
    $('#user-menu').slideUp(200);
    $('#user').removeClass('active');
});

$('.block--job').click(function(e) {
   e.preventDefault();
   $('#overlay').fadeIn(200);
   $('.overlay').fadeIn(200);
});

$('#overlay').click(function(e) {
    e.preventDefault();
    $('#overlay').fadeOut(200);
    $('.overlay').fadeOut(200);
});
