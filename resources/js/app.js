
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

// -------------------------------
// INI: Search compontents

Vue.component('search-bar', require('./components/SearchBar.vue'));

// FIM: Search compontents
// -------------------------------

// -------------------------------
// INI: Generic compontents

Vue.component('profile-grid', require('./components/ProfileGrid.vue'));
Vue.component('pagination', require('./components/Pagination.vue'));

// FIM: Generic compontents
// -------------------------------

// -------------------------------
// INI: Home compontents

Vue.component('home-posts', require('./components/HomePosts.vue'));

// END: Home compontents
// -------------------------------

// -------------------------------
// INI: Profile components

Vue.component('profile-preview', require('./components/Profile.vue'));
Vue.component('profile-editor', require('./components/ProfileEditor.vue'));

// END: Profile components
// -------------------------------

const app = new Vue({
    el: '#app'
});
