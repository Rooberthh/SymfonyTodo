/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you require will output into a single css file (app.scss in this case)
require('../css/app.scss');

// Need jQuery? Install it with "yarn add jquery", then uncomment to require it.
// var $ = require('jquery');

import Vue from 'vue';
import TasksList from './components/tasksList.vue'
window.axios = require('axios');
/**
 * Create a fresh Vue Application instance
 */
new Vue({
    el: '#app',
    components: {TasksList}
});
