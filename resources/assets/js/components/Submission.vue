<template>
    <div class="submission-vue" v-if="ready">

        <submission-navigation
            :sections="sections"
            :improvements="currentImprovements">
        </submission-navigation>

        <div class="my-4 container" v-if="currentSectionIndex=='details'">
            <submission-details
                :assessment="assessment">
            </submission-details>
        </div>

        <div class="my-4 container" v-if="currentSectionIndex!='details'">

            <h1 class="my-3">{{ currentSection.title }}</h1>
            <p class="lead mb-5">{{ currentSection.description }}</p>

            <div class="improvement-card card mb-5"
                :id="'improvement-'+improvement.id"
                v-for="(improvement, index) in currentImprovements">
                <div class="card-body">

                    <h2 class="card-title">
                        <span class="badge badge-secondary improvement-no mr-3">
                            {{ index + 1 }}
                        </span>
                        {{ improvement.title }}
                    </h2>

                    <p>{{ improvement.description }}</p>

                    <div v-if="improvement.assessor_guidance" class="alert alert-danger">
                        <p>{{ improvement.assessor_guidance }}</p>
                    </div>

                    <submission-comment
                        :improvement="improvement"
                        :sectionIndex="currentSectionIndex"
                        :improvementIndex="index"
                    ></submission-comment>

                </div>
                <div class="card-footer">
                    <submission-buttons
                        :sectionIndex="currentSectionIndex"
                        :improvementIndex="index">
                    </submission-buttons>
                </div>
            </div>

            <submission-pagination
                :sectionIndex="currentSectionIndex"
                :sectionsLength="sections.length">
                <button class="btn btn-warning"
                    v-on:click="submitForm">Submit</button>
            </submission-pagination>

        </div>
    </div>
</template>

<script>
    import FormMixin from '../mixins/form.js'
    import SubmissionButtons from './SubmissionButtons.vue'
    import SubmissionComment from './SubmissionComment.vue'
    import SubmissionDetails from './SubmissionDetails.vue'
    import SubmissionNavigation from './SubmissionNavigation.vue'
    import SubmissionPagination from './SubmissionPagination.vue'

    export default {
        props: ['baseUrl', 'assessment', 'sections', 'improvements'],
        mixins: [FormMixin],
        components: {
            'submission-buttons': SubmissionButtons,
            'submission-comment': SubmissionComment,
            'submission-details': SubmissionDetails,
            'submission-navigation': SubmissionNavigation,
            'submission-pagination': SubmissionPagination
        },
        mounted() {
            let initImprovements = _.chain(this.improvements)
                .map(function (imp) {
                    return _.extend(imp, {value: null, comment: null})
                })
                .groupBy(function (imp) {
                    return imp.section_id
                })
                .value()
            let initSections = _.map(this.sections, (x) => {
                return _.extend(x, {improvements: initImprovements[x.id]})
            })
            this.$store.commit('init', initSections)

        },
        computed: {
            ready() {
                return this.$store.getters.ready
            },
            currentSection() {
                if ('details' == this.currentSectionIndex) {
                    return false
                }
                return this.$store.getters.currentSection
            },
            currentSectionIndex: {
                get() {
                    return this.$store.getters.currentSectionIndex
                },
                set(value) {
                    this.$store.commit('setCurrentSection', value)
                }
            },
            currentImprovements() {
                if (!this.currentSection) {
                    return false
                }
                return this.currentSection.improvements
            }
        },
        methods: {
            nextSection(increment) {
                this.currentSectionIndex += increment
            },
            improvementsInSection(section_id) {
                return _.filter(this.improvements, (x) => {
                    return x.section_id == section_id
                })
            }
        }
    }
</script>
