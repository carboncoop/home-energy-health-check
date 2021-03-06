import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex)

const store = new Vuex.Store({
    state: {
        ready: false,
        assessment: {},
        parts: [],
        descriptionsVisible: {}
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
        },
        toggleVisible(state, impId) {
            if (impId in state.descriptionsVisible) {
                state.descriptionsVisible[impId] = !state.descriptionsVisible[impId]
            } else {
                Vue.set(state.descriptionsVisible, impId, true)
                //state.descriptionsVisible[impId] = true
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
        getVisible(state) {
            return (impId) => {
                if (_.has(state.descriptionsVisible, impId)) {
                    return state.descriptionsVisible[impId]
                }
                return false
            }
        },
        getCompletedParts(state) {
            return _.map(state.parts, (sec) => {
                return _.every(sec.improvements, (imp) => {
                    return (imp.value != null)
                })
            })
        },
        getCompletedImprovements(state) {
            return _.map(state.parts, (sec) => {
                return _.map(sec.improvements, (imp) => {
                    return (imp.value != null)
                })
            })
        },
        getEditFormData(state) {
            let improvements = _.flatMap(state.parts, (part) => {
                return _.transform(part.improvements, (xs, x) => {
                    xs.push({
                        improvement_id: x.id,
                        value: x.value,
                        comment: x.comment
                    })
                }, [])
            })
            return {
                improvements: improvements,
                assessment: state.assessment
            }
        },
        getCreateFormData(state) {
            return {
                assessment: state.assessment
            }
        }
    }
})

export default store
