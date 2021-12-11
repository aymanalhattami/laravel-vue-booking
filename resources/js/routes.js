import VueRouter from "vue-router";
import Example2 from "./components/Example2";
import Bookables from "./bookables/Bookables";

const routes = [
    {
        path: '/', 
        component: Bookables,
        name: 'home'
    },
    {
        path: '/2', 
        component: Example2,
        name: 'example'
    }
];

const router = new VueRouter({
    routes: routes,
    mode: 'history',
});

export default router;