export default {
    localStorage: {
        savedAssessments: {
            type: Array,
            default: []
        }
    },
    methods: {
        saveLocally() {
            let assessments = this.$localStorage.get('savedAssessments')
            let formData = this.$store.getters.getEditFormData
            let id = formData.assessment.id
            let exists = _.filter(assessments, {id: id})
            //console.log(exists, _.isEmpty(exists))
            if (_.isEmpty(exists)) {
                assessments.push({
                    id: id,
                    data: formData
                })
                console.warn("new", assessments, id, formData)
            } else {
                let index = _.findIndex(assessments, {id: id})
                Vue.set(assessments, index, {id: id, data: formData})
                console.warn("exists", assessments, id, formData)
            }

            this.$localStorage.set('savedAssessments', assessments)
        }
    }
}
