<template>
    <div class="submission-vue">
        <div class="my-4 container" v-if="currentSection">

            <submission-navigation :sections="sections"
                :improvements="currentImprovements">
            </submission-navigation>

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
                </div>
                <div class="card-footer">
                    <submission-buttons
                        :sectionIndex="currentSectionIndex"
                        :improvementIndex="index">
                    </submission-buttons>
                </div>
            </div>

            <div class="text-center">
                <button class="btn btn-primary"
                    v-on:click="nextSection(-1)">Previous Section</button>
                <button class="btn btn-primary"
                    v-on:click="nextSection(1)">Next Section</button>
                <button class="btn btn-warning"
                    v-on:click="submitForm">Submit</button>
            </div>

        </div>
    </div>
</template>

<script>
    import FormMixin from '../mixins/form.js'
    import SubmissionButtons from './SubmissionButtons.vue'
    import SubmissionNavigation from './SubmissionNavigation.vue'

    export default {
        props: ['baseUrl', 'reportId', 'sections', 'improvements'],
        mixins: [FormMixin],
        components: {
            'submission-navigation': SubmissionNavigation,
            'submission-buttons': SubmissionButtons
        },
        mounted() {
            let initImprovements = _.chain(this.improvements)
                .map(function (imp) {
                    return _.extend(imp, {value: null})
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
            currentSection() {
                return this.$store.getters.currentSection
            },
            currentSectionIndex() {
                return this.$store.getters.currentSectionIndex
            },
            currentImprovements() {
                return this.currentSection.improvements
            }
        },
        methods: {
            nextSection(increment) {
                //this.currentSectionId += 1
            },
            improvementsInSection(section_id) {
                return _.filter(this.improvements, (x) => {
                    return x.section_id == section_id
                })
            }
        }
    }
</script>
