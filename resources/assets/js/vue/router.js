import Vue from 'vue';
import VueRouter from 'vue-router';
import Index from './components/front/homepage/Index';
import ListingsList from "./components/front/listings/List.vue";
import Services  from './components/front/listings/Services.vue';
// import Browse from "./components/front/browse/Browse.vue";
// import ViewListing from "./components/front/listings/View.vue";
import ProjectDetails from './components/front/project/ProjectDetails';
import Service from './components/front/service/Service';
import GeneralTerms from './components/front/homepage/GeneralTerms';
import PrivateProtection from './components/front/homepage/PrivateProtection';
// import AllArticles from './components/front/blog/AllArticles';
// import Article from './components/front/blog/Article';
import Profile from './components/front/profile/Profile';
import Contacts from './components/front/homepage/Contacts';

Vue.use(VueRouter);

const routes = [
    { path: '/', name: 'Index', component: Index , props: true},
    { path: '/project/details/:id', component: ProjectDetails, name: 'ProjectDetails', props: true },
	{ path: '/service/details/:id', component: Service, name: 'Service', props: true },
	{ path: '/listings/:filters?', component: ListingsList, name: 'ListingsList', props: true },
	{ path: '/Services/:filters?', component: Services, name: 'Services', props: true },
	// { path: '/listing/:id', component: ViewListing, name: 'ViewListing', props: true },
	// { path: '/browse', component: Browse, name: 'Browse', props: true },
	{ path: '/general_terms', component: GeneralTerms, name: 'GeneralTerms' },
	{ path: '/private_protection', component: PrivateProtection, name: 'PrivateProtection' },
	{ path: '/profile/:id', component: Profile, name: 'Profile', props: true },
	{ path: '/contacts', component: Contacts, name: 'Contacts' },
	// { path: '/blog', component: AllArticles, name: 'AllArticles', props: true },
	
	// { path: '/blog/articles/:url?/:id', component: Article, name: 'Article', props: true },
];

export default new VueRouter({
    mode: 'history',
    routes,
});
