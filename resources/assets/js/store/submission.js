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
        selectChoice (state, payload) {
            state.sections[payload.section_id][payload.improvement_id].value = payload.value
        }
    },
    getters: {
        completedSections(state) {
            true
        },
        getValue(state) {
            return (payload) => {
                if (payload.section_id in state.sections) {
                    let section = state.sections[payload.section_id]
                    return section[payload.improvement_id].value
                }
            }
        }
    }
})

export default store
