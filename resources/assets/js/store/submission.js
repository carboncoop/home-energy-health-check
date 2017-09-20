import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex)

const store = new Vuex.Store({
    state: {
        sections: []
    },
    mutations: {
        init(state, payload) {
            state.sections = payload
        },
        selectChoice (state, x) {
            console.warn(x)
            state.count++
        }
    }
})

export default store
