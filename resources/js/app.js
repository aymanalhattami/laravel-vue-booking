require('./bootstrap');
import router from "./routes";
import VueRouter from 'vue-router'
// import Vue from "vue";
import Index from './index';


window.Vue = require('vue').default;
Vue.use(VueRouter);

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('example-component', require('./components/ExampleComponent.vue').default);

const app = new Vue({
    el: '#app',
    router: router,
    components:{
        'index': Index
    }
});
