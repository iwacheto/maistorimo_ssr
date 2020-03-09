import Vue from 'vue';
import uniq from 'lodash/uniq';
import Vuex, { Store } from 'vuex';

Vue.use(Vuex);

export default new Store({
    state: {
        packages: [],
        user:[],
        position: {},
        test:'Peshonatora'
    },

    getters: {
        types: state => uniq(state.packages.map(p => p.type)).sort(),
        position: state => state.position,
        packagesWithType: state => type => state.packages.filter(p => p.type === type),
    },

    mutations: {
        setPackages(state, { packages }) {
            state.packages = packages;
        },
        changePosition(state, data) {
			state.position = data
		}
    },
});