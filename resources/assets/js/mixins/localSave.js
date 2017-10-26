export default {
    data() {
        return {
            isSavedLocally: false
        }
    },
    localStorage: {
        savedAssessments: {
            type: Array,
            default: []
        }
    },
    computed: {
        localAssessments: {
            get() {
                return this.$localStorage.get('savedAssessments')
            },
            set(value) {
                this.$localStorage.set('savedAssessments', value)
            }
        }
    },
    methods: {
        saveLocally() {
            let formData = this.$store.getters.getEditFormData
            let id = formData.assessment.id
            let assessments = this.localAssessments
            let exists = _.filter(this.localAssessments, {id: id})
            if (!_.isEmpty(exists)) {
                let index = _.findIndex(assessments, {id: id})
                Vue.set(assessments, index, {id: id, data: formData})
            } else {
                assessments.push({
                    id: id,
                    data: formData
                })
            }
            this.localAssessments = assessments
            this.isSavedLocally = true
        }
    }
}
