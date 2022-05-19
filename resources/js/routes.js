import VueRouter from "vue-router";
import Bookables from "./bookables/Bookables.vue";
import Bookable from './bookable/Bookable.vue';
import Review from './Reivew/Review.vue';

const routes = [{
        path: '/',
        component: Bookables,
        name: 'home'
    },
    {
        path: '/bookable/:id',
        component: Bookable,
        name: 'bookable'
    },
    {
        path: '/review/:id',
        component: Review,
        name: 'review'
    }
];

const router = new VueRouter({
    routes: routes,
    mode: 'history',
});

export default router;