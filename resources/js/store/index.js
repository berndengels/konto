import Vue from "vue"
import Vuex from "vuex"

Vue.use(Vuex);
const ApiURL = 'http://konto.test/api/konto'

export default new Vuex.Store({
    state: {
        all: [],
        one: null,
    },
    getters: {
        all: state => {
            state.all.map((item) => {
                item.buchungstag = (new Date(item.buchungstag)).toLocaleDateString()
                return item
            })
            return state.all
        },
        one: state => state.one,
        uniq: state => _.uniq(state.all.map(item => item.wer)),
//        filter: state => query => state.all.filter(item => item.wer.includes(query)),
    },
    actions: {
        async getAll({ commit }) {
            const response = await iAxios.get('/konto');
            commit('all', await response.data);
        },
        async getOne({ commit }, id) {
            const response = await iAxios.get('/konto/' + id);
            commit('one', await response.data);
        },
    },
    mutations: {
        all: (state, all) => state.all = all,
        one: (state, one) => state.one = one,
        search: (state, search) => {
            search = search.toLowerCase()
            state.all = state.all.filter(item => {
                if("" === search) {
                    return item
                }
                else if(item.wer.toLowerCase().indexOf(search) !== -1) {
                    return item
                }
            })
        },
    },
});
