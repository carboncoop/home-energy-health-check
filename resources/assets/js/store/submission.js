import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex)

const store = new Vuex.Store({
    state: {
        currentSectionIndex: 0,
        sections: []
    },
    mutations: {
        init(state, payload) {
            state.sections = payload
        },
        setValue (state, obj) {
            if (obj.section_index in state.sections) {
                let section = state.sections[obj.section_index]
                section.improvements[obj.improvement_index].value = obj.value
            }
        },
        setCurrentSection(state, index) {
            state.currentSectionIndex = index
        }
    },
    getters: {
        currentSection(state) {
            return state.sections[state.currentSectionIndex]
        },
        currentSectionIndex(state) {
            return  state.currentSectionIndex
        },
        valueAtIndices(state) {
            return (obj) => {
                if (obj.section_index in state.sections) {
                    let section = state.sections[obj.section_index]
                    return section.improvements[obj.improvement_index].value
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
                    xs['improvement.'+x.id] = x.value
                }, {})
                _.extend(ys, y1)
            }, {})
        }
    }
})

export default store
