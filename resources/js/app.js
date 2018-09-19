/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */


require('./bootstrap');
window.Vue = require('vue');
import VueRouter from 'vue-router';
import Vuex from 'vuex';
import { routes } from './routes';
import MainApp from './components/MainApp';
import { initialize } from "./helpers/general";

Vue.use(VueRouter);
Vue.use(Vuex);


const router = new VueRouter({
    routes,
    mode: 'history'
});

initialize(router);

const app = new Vue({
    render: h => h(MainApp),
    router,
    components: {
        MainApp
    }
}).$mount("#app");
