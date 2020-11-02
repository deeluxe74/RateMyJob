import Vue from 'vue';
import Vuex from 'vuex';
import createPersistedState from "vuex-persistedstate";

Vue.use(Vuex);

export const store = new Vuex.Store({
    plugins: [createPersistedState()],
    state: {
        pictures: []
    },
    getters: {
        pictures(state){
            return state.pictures;
        }
    },
    mutations: {
        SET_PICTURES(state, picture){
            state.pictures.push(picture);
        },
    },
    actions: {
        userVote({ commit }, payload){
            commit('SET_PICTURES', payload);
        },
    }
});