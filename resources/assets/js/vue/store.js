import Vue from 'vue';
import uniq from 'lodash/uniq';
import Vuex, { Store } from 'vuex';
import axios from 'axios';

Vue.use(Vuex);

export default new Store({
    state: {
        // packages: [],
        item: {
            // title:'Pesho',
            // description:'Pesho nosi vsi4ko'
        },
        projects: {},
        project:{},
        projectCategories: [],
        serviceCategories: [],

    },

    getters: {
        // types: state => uniq(state.packages.map(p => p.type)).sort(),

        // packagesWithType: state => type => state.packages.filter(p => p.type === type),
    },
    actions: {
        getProject({ commit }) {
            // return the Promise via `store.dispatch()` so that we know
            // when the data has been fetched
            commit('SET_ITEM', { id, item })
        }
    },

    mutations: {
        SET_ITEM(state, item) {
            state.item = item
        },
        SET_PROJECTS(state, projects) {
            state.projects = projects
        },
        getProject2() {
            const res = axios.get('/projects/42');
            this.$nextTick(() => {
                this.name = res.data.project.title;
                this.ogImage = res.data.project.project_galleries[0].url;
                const realDesc = res.data.project.description
                    .split(' ')
                    .slice(0, 25)
                    .join(' ');
                this.content = realDesc;
                this.ogUrl = 'https://maistorimo.bg/project/details/' + this.id;
            });

            if (res.data.project.project_services.length > 0) {
                this.services.push(res.data.project.project_services[0].service);
            }
            this.images = res.data.project.project_galleries.map(image => image.url);
            let currentDateWithFormat = new Date()
                .toJSON()
                .slice(0, 10)
                .replace(/-/g, '-');
            const responce = axios.post('/analytics', {
                user: this.vendorDetails.id,
                project: this.id,
                object_type: 'project',
                date: currentDateWithFormat,
            });
        }
    },
});
