import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex)

const store = new Vuex.Store({
    state: {
        ready: false,
        sections: []
    },
    mutations: {
        init(state, payload) {
            state.sections = payload
            state.ready = true
        },
        setValue(state, obj) {
            if (obj.section_index in state.sections) {
                let section = state.sections[obj.section_index]
                section.improvements[obj.improvement_index].value = obj.value
            }
        },
        setComment(state, obj) {
            if (obj.section_index in state.sections) {
                let section = state.sections[obj.section_index]
                section.improvements[obj.improvement_index].comment = obj.comment
            }
        }
    },
    getters: {
        ready(state) {
            return state.ready
        },
        getValue(state) {
            return (obj) => {
                if (obj.section_index in state.sections) {
                    let section = state.sections[obj.section_index]
                    return section.improvements[obj.improvement_index].value
                }
            }
        },
        getComment(state) {
            return (obj) => {
                if (obj.section_index in state.sections) {
                    let section = state.sections[obj.section_index]
                    return section.improvements[obj.improvement_index].comment
                }
            }
        },
        completedSections(state) {
            return _.map(state.sections, (sec) => {
                return _.every(sec.improvements, (imp) => {
                    return (imp.value != null)
                })
            })
        },
        formData(state) {
            return _.transform(state.sections, (ys, y) => {
                let y1 = _.transform(y.improvements, (xs, x) => {
                    xs[x.id] = {
                        value: x.value,
                        comment: x.comment
                    }
                }, {})
                _.extend(ys, y1)
            }, {})
        }
    }
})

export default store
