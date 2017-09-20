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
                        :improvementId="improvement.id"
                        v-on:selectChoice="selectChoice">
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
        components: {
            'submission-navigation': SubmissionNavigation,
            'submission-buttons': SubmissionButtons
        },
        props: ['sections', 'improvements'],
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
                return this.improvementsInSection(thus.currentSectionId)
            },
            completedSections() {
                let f = _.map(this.sections, (section) => {
                    let imps = this.improvementsInSection(section.id)
                    return _.every(imps, (imp) => {
                        console.warn(imp)
                        return imp.value != null
                    })
                })
                console.warn(f)
                return f
            }
        },
        methods: {
            changeSection(section_id) {
                this.currentSectionId = section_id
            },
            selectChoice(data) {
                let str = 'improvement.' + data.improvement + '.status';
                this.formFields[str] = data.value
            },
            improvementsInSection(section_id) {
                return _.filter(this.improvements, (x) => {
                    return x.section_id == section_id
                })
            }
        }
    }
</script>
