/**
 * Load the App dependencies
 */
require('./bootstrap');
window.Vue = require('vue');


/**
 * Register the Global Vue Components
 */
Vue.component('vue-header', require('./components/common/VueHeader.vue').default);

/**
 * Instantiate the Vue application
 */
const app = new Vue({
    el: '#app'
});
