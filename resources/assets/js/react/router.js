import Vue from 'vue';
import VueRouter from 'vue-router';
import Vendor from './components/Vendor';
import Dashboard from './components/dashboard/Dashboard';
import AddListing from "./components/listing/AddListing.vue";
import ProjectsList from "./components/listing/List.vue";
import EditProject from "./components/listing/EditProject.vue";
import Profile from "./components/profile/Profile.vue";
import Website from "./components/website/Website.vue";
import ProjectsAnalitycs from "./components/analitycs/ProjectsAnalitycs";
import ServiceAnalitycs from "./components/analitycs/ServiceAnalitycs.vue";
import ContactAnalitycs from "./components/analitycs/ContactAnalitycs.vue";
import CreateArticle from './components/blog/CreateArticle';
import EditArticle from './components/blog/EditArticle';
import ArticlesList from './components/blog/ArticlesList';
import CreateService from './components/services/CreateService';
import EditService from './components/services/EditService';
import ServicesList from './components/services/ServicesList';


Vue.use(VueRouter);

const routes = [
    // { path: '/vue/', name: 'Vendor', component: Vendor },
    { path: '/admin', name: 'Dashboard', component: Dashboard },
    { path: '/admin/add-listing', component: AddListing, name: 'AddListing', props: true },
	{ path: '/admin/projects', component: ProjectsList, name: 'ProjectsList', props: true },
	{ path: '/admin/projects/edit/:id', component: EditProject, name: 'EditProject', props: true },
	{ path: '/admin/profile', component: Profile, name: 'Profile', props: true },
	{ path: '/admin/website', component: Website, name: 'Website', props: true },
	{ path: '/admin/projects_analitycs', component: ProjectsAnalitycs, name: 'ProjectsAnalitycs', props: true },
	{ path: '/admin/services_analitycs', component: ServiceAnalitycs, name: 'ServiceAnalitycs', props: true },
	{ path: '/admin/contacts_analitycs', component: ContactAnalitycs, name: 'ContactAnalitycs', props: true },
	{ path: '/admin/blog/add-article', component: CreateArticle, name: 'CreateArticle', props: true },
	{ path: '/admin/blog/articles', component: ArticlesList, name: 'ArticlesList', props: true },
	{ path: '/admin/blog/articles/edit/:id', component: EditArticle, name: 'EditArticle', props: true },
    { path: '/admin/service', component: ServicesList, name: 'ServicesList', props: true },
	{ path: '/admin/service/add-service', component: CreateService, name: 'CreateService', props: true },
	{ path: '/admin/service/edit/:id', component: EditService, name: 'EditService', props: true },
	
    
];

export default new VueRouter({
    // mode: 'history',
    routes,
});