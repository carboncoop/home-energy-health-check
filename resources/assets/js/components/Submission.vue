<template>
    <div class="submission-vue">
        <div class="my-4 container">
            <submission-navigation :sections="sections"
                :currentSectionId="currentSectionId"
                :improvements="currentImprovements"
                v-on:changeSection="changeSection">
            </submission-navigation>
            {{ completedSections }}
            <h2 class="my-2">{{ currentSection.title }}</h2>
            <p class="lead">{{ currentSection.description }}</p>
            <div class="card mb-5" :id="'improvement-'+improvement.id"
                v-for="improvement in currentImprovements">
                <div class="card-body">
                    <h3 class="card-title">{{ improvement.title }}</h3>
                    <p>{{ improvement.description }}</p>
                </div>
                <div class="card-footer">
                    <submission-buttons
                        :sectionId="currentSection.id"
                        :improvementId="improvement.id">
                    </submission-buttons>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import SubmissionButtons from './SubmissionButtons.vue'
    import SubmissionNavigation from './SubmissionNavigation.vue'

    export default {
        props: ['sections', 'improvements'],
        mounted() {
            let initSections = _.chain(this.improvements)
                .map(function (imp) {
                    return _.extend(imp, {value: null})
                })
                .groupBy(function (imp) {
                    return imp.section_id
                })
                .mapValues(function (section) {
                    return _.mapKeys(section, function (imp, key) {

                        return imp.id
                    })
                })
                .value()
            this.$store.commit('init', initSections)
        },
        components: {
            'submission-navigation': SubmissionNavigation,
            'submission-buttons': SubmissionButtons
        },
        data() {
            return {
                formFields: {},
                currentSectionId: 1
            }
        },
        computed: {
            currentSection() {
                return this.sections[this.currentSectionId]
            },
            currentImprovements() {
                return this.improvementsInSection(this.currentSectionId)
            },
            completedSections() {
                return this.$store.getters.completedSections
            }
        },
        methods: {
            changeSection(section_id) {
                this.currentSectionId = section_id
            },
            improvementsInSection(section_id) {
                return _.filter(this.improvements, (x) => {
                    return x.section_id == section_id
                })
            }
        }
    }
</script>
