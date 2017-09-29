<template>
    <div class="submission-vue" v-if="ready">

        <navigation
            :sections="sections"
            :improvements="currentImprovements">
        </navigation>

        <div class="my-4 container">
            <router-view
                :assessment="assessment"
                :sections="sections"
            ></router-view>

            <button class="btn btn-warning"
                v-on:click="submitForm">Submit</button>
        </div>
    </div>
</template>

<script>
    import FormMixin from '../mixins/form.js'
    import Navigation from './partial/Navigation.vue'

    export default {
        props: ['baseUrl', 'assessment', 'sections', 'improvements'],
        mixins: [FormMixin],
        components: {
            'navigation': Navigation
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
            currentImprovements() {
                if (!this.currentSection) {
                    return false
                }
                return this.currentSection.improvements
            }
        },
        methods: {
            currentSectionIndex() {
                return _.findIndex(this.sections, (section) => {
                    return section.id == this.sectionId
                })
            },
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
