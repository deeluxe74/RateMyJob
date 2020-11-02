require('./bootstrap');

import Index from './Index';
import { router } from './routes.js';
import { store } from './store.js';

window.Vue = require('vue');

const app = new Vue({
    el: '#app',
    router,
    store,
    components: {
        Index,
    }
});
