require('./bootstrap');

import Index from './Index';
import { router } from './routes.js';

window.Vue = require('vue');

const app = new Vue({
    el: '#app',
    router,
    components: {
        Index,
    }
});
