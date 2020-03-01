import Vue from 'vue';
import VueRouter from 'vue-router';
import Vendor from './components/Vendor';


Vue.use(VueRouter);

const routes = [
    { path: '/vue/', name: 'Vendor', component: Vendor },
    
];

export default new VueRouter({
    mode: 'history',
    routes,
});