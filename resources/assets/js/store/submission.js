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
        isSectionComplete(state) {
            return (section_id) => {
                if (section_id in state.sections) {
                    return _.every(state.sections[section_id], (x) => {
                        return (x.value != null)
                    })
                }
            }
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
