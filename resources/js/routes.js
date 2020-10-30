import { first } from 'lodash';
import Vue from 'vue';
import VueRouter from 'vue-router';

Vue.use(VueRouter);

import CardList from './components/CardList';
import Post from './components/Post';

const routes =
    [
        {
            name: 'CardList',
            path: '/',
            component: CardList
        },
        {
            name: 'Post',
            path: '/nouveau',
            component: Post
        },

    ]

export const router = new VueRouter({
    mode: 'history',
    routes
});