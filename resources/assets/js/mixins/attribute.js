export default {
    computed: {
        attribute: {
            get() {
                return this.$store.getters.getAssessmentAttribute(
                    this.attributeName
                )
            },
            set(value) {
                this.debouncedSet(value)
            }
        }
    },
    methods: {
        debouncedSet: _.debounce(function (value) {
            this.$store.commit('setAssessmentAttribute', {
                key: this.attributeName,
                value: value
            })
        }, 330)
    }
}
