import Vue from 'vue';
import store from './store';
import router from './router';
import Vendor from './components/Vendor';

export default new Vue({
    store,

    router,

    render: h => h(Vendor),
});