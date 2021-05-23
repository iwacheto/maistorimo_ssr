// window.Vue = require('vue');
import Vue from 'vue/dist/vue.js';
window.axios = require('axios');
import Vuex from 'vuex'

import VueRouter from 'vue-router'
import ImageUploader from 'vue-image-upload-resize'
import Vuetify from 'vuetify'
import VeeValidate from 'vee-validate';
import VueSweetalert2 from 'vue-sweetalert2';
import VueToastr from 'vue-toastr';
import * as VueGoogleMaps from "vue2-google-maps";
import CKEditor from '@ckeditor/ckeditor5-vue';

Vue.use(VueGoogleMaps, {
	load: {
		key: "AIzaSyC0jEZf-2juLNwOK0LYmdKA6d1WC0JlknI",
		libraries: "places" // necessary for places input
	}
});
Vue.use(Vuex)
Vue.component('vue-toastr', VueToastr);


Vue.use(CKEditor);

import 'froala-editor/css/froala_editor.pkgd.min.css';

// Import and use Vue Froala lib.
import VueFroala from 'vue-froala-wysiwyg';
Vue.use(VueFroala);

// Global register
Vue.use(VueSweetalert2);
Vue.use(VueRouter)
Vue.use(Vuetify)
Vue.use(ImageUploader);
Vue.use(VeeValidate);
// index.js or main.js
// import 'vuetify/dist/vuetify.min.css'


const store = new Vuex.Store({
	state: {
		position: {}
	},
	mutations: {
		changePosition(state, data) {
			state.position = data


		}
	},
	getters: {
		position: state => state.position
	}
});

import Vendor from './Vendor';
import AddListing from "./listing/AddListing.vue";
import ProjectsList from "./listing/List.vue";
import Dashboard from "./dashboard/Dashboard.vue";
import EditProject from "./listing/EditProject.vue";
import Profile from "./profile/Profile.vue";
import Website from "./website/Website.vue";
import ProjectsAnalitycs from "./analitycs/ProjectsAnalitycs";
import ServiceAnalitycs from "./analitycs/ServiceAnalitycs.vue";
import ContactAnalitycs from "./analitycs/ContactAnalitycs.vue";
import CreateArticle from './blog/CreateArticle';
import EditArticle from './blog/EditArticle';
import ArticlesList from './blog/ArticlesList';
import CreateService from './services/CreateService';
import EditService from './services/EditService';
import ServicesList from './services/ServicesList';
import VueAnalytics from 'vue-analytics'

const routes = [
	{ path: '/', component: Dashboard, name: 'Dashboard', props: true },
	{ path: '/add-listing', component: AddListing, name: 'AddListing', props: true },
	{ path: '/projects', component: ProjectsList, name: 'ProjectsList', props: true },
	{ path: '/projects/edit/:id', component: EditProject, name: 'EditProject', props: true },
	{ path: '/profile', component: Profile, name: 'Profile', props: true },
	{ path: '/website', component: Website, name: 'Website', props: true },
	{ path: '/projects_analitycs', component: ProjectsAnalitycs, name: 'ProjectsAnalitycs', props: true },
	{ path: '/services_analitycs', component: ServiceAnalitycs, name: 'ServiceAnalitycs', props: true },
	{ path: '/contacts_analitycs', component: ContactAnalitycs, name: 'ContactAnalitycs', props: true },
	{ path: '/blog/add-article', component: CreateArticle, name: 'CreateArticle', props: true },
	{ path: '/blog/articles', component: ArticlesList, name: 'ArticlesList', props: true },
	{ path: '/blog/articles/edit/:id', component: EditArticle, name: 'EditArticle', props: true },
    { path: '/service', component: ServicesList, name: 'ServicesList', props: true },
	{ path: '/service/add-service', component: CreateService, name: 'CreateService', props: true },
	{ path: '/service/edit/:id', component: EditService, name: 'EditService', props: true },
]

const router = new VueRouter({
	routes // short for `routes: routes`
})


Vue.component('gp-header', name = "gp-header", require('./partials/Header.vue').default);
Vue.component('gp-menu', require('./partials/Menu.vue').default);
// Vue.component('snackbar', Snackbar);


Vue.use(VueAnalytics, {
	id: 'UA-156493837-1',
	router
})

// ga('set', 'page', router.currentRoute.path);
// ga('send', 'pageview');

router.afterEach((to, from) => {
	ga('set', 'page', to.path);
	ga('send', 'pageview');
});

window.onload = function () {
	const app = new Vue({
		store,
		el: '#app',
		router: router,
		render: h => h(Vendor),
	});
};
