import Vue from 'vue';
import uniq from 'lodash/uniq';
import Vuex, { Store } from 'vuex';

Vue.use(Vuex);

export default new Store({
    state: {
        // packages: [],
        item: {
            title:'Pesho',
            description:'Pesho nosi vsi4ko'
        },
        projects:{},
        projectCategories: [],
        serviceCategories: [],
    },

    getters: {
        types: state => uniq(state.packages.map(p => p.type)).sort(),

        packagesWithType: state => type => state.packages.filter(p => p.type === type),
    },

    mutations: {
        SET_ITEM(state, item) {
            state.item = item
        },
        SET_PROJECTS(state, projects){
            state.projects=projects
        }
    },
});
