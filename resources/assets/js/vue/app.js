import Vue from 'vue';
import store from './store';
// import { createStore } from './store2';
import router from './router';
import App from './components/App';
import VueLazyload from 'vue-lazyload';
import * as VueGoogleMaps from "vue2-google-maps";
import VeeValidate from 'vee-validate';
import id from './components/front/locale-id';
import VueAnalytics from 'vue-analytics';
import VueScrollTo from 'vue-scrollto';
import VueMeta from 'vue-meta'



Vue.directive('click-outside', {
	bind: function (el, binding, vnode) {
		window.event = function (event) {
			if (!(el == event.target || el.contains(event.target))) {
				vnode.context[binding.expression](event);
			}
		};
		document.body.addEventListener('click', window.event)
	},
	unbind: function (el) {
		document.body.removeEventListener('click', window.event)
	},
});

// const store = createStore();

Vue.use(VueGoogleMaps, {
	load: {
		key: "AIzaSyCX1iw9Pr-kaeGN7IMHB4LrxzaHSRHJtSM",
		// key: "AIzaSyDV8xHwHpLZ2zsESGtzmBEtXCjjhMzdhcs",
		libraries: "places" // necessary for places input
	}
});

Vue.use(VeeValidate);
const rulesPlugin = ({ Validator }) => {
    Validator.localize('id', id);
  };
VeeValidate.use(rulesPlugin);

Vue.use(VueAnalytics, {
    id: 'UA-156481379-1',
    router
})

Vue.use(VueLazyload);
// Vue.use(VueScrollTo);
Vue.use(VueMeta);

import { EventBus } from './components/front/event-bus';


// Vue.use(axios)
export default new Vue({
	store,
    router,

    render: h => h(App),
});
