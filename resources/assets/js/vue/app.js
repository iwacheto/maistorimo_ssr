import Vue from 'vue';
import store from './store';
import router from './router';
import App from './components/App';
import axios from 'axios';

// Vue.use(axios)
export default new Vue({
    store,
    router,

    render: h => h(App),
});
