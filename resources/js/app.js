require('./bootstrap');
import router from "./routes";
import VueRouter from 'vue-router'
// import Vue from "vue";
import Index from './index';
import Vue from "vue";
// import starRating from './shared/components/StarRating.vue';


window.Vue = require('vue').default;
Vue.use(VueRouter);

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('star-rating', require('./shared/components/StarRating.vue').default);
Vue.component('fatal-error', require('./shared/components/FatalError.vue').default);
Vue.component('v-error', require('./shared/components/ValidationErrors.vue').default);
Vue.component('success', require('./shared/components/Success.vue').default);

const app = new Vue({
    el: '#app',
    router: router,
    components:{
        'index': Index
    }
});
