export default {
    computed: {
        attribute: {
            get() {
                return this.$store.getters.getAssessmentAttribute(
                    this.attributeName
                )
            },
            set(value) {
                this.$store.commit('setAssessmentAttribute', {
                    key: this.attributeName,
                    value: value
                })
            }
        }
    }
}
