import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex)

const store = new Vuex.Store({
    state: {
        ready: false,
        assessment: {},
        parts: []
    },
    mutations: {
        init(state, obj) {
            state.assessment = obj.assessment
            state.parts = obj.parts
            state.ready = true
        },
        setAssessmentAttribute(state, obj) {
            state.assessment[obj.key] = obj.value
        },
        setValue(state, obj) {
            if (obj.part_index in state.parts) {
                let part = state.parts[obj.part_index]
                part.improvements[obj.improvement_index].value = obj.value
            }
        },
        setComment(state, obj) {
            if (obj.part_index in state.parts) {
                let part = state.parts[obj.part_index]
                part.improvements[obj.improvement_index].comment = obj.comment
            }
        }
    },
    getters: {
        ready(state) {
            return state.ready
        },
        getAssessmentAttribute(state) {
            return (attributeName) => {
                return state.assessment[attributeName]
            }
        },
        getValue(state) {
            return (obj) => {
                if (obj.part_index in state.parts) {
                    let part = state.parts[obj.part_index]
                    return part.improvements[obj.improvement_index].value
                }
            }
        },
        getComment(state) {
            return (obj) => {
                if (obj.part_index in state.parts) {
                    let part = state.parts[obj.part_index]
                    return part.improvements[obj.improvement_index].comment
                }
            }
        },
        completedParts(state) {
            return _.map(state.parts, (sec) => {
                return _.every(sec.improvements, (imp) => {
                    return (imp.value != null)
                })
            })
        },
        formData(state) {
            return _.transform(state.parts, (ys, y) => {
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
