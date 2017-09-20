<template>
    <div class="submission-vue">
        <div class="my-4 container">
            <submission-navigation :sections="sections"
                :currentSectionId="currentSectionId"
                :improvements="currentImprovements"
                v-on:changeSection="changeSection">
            </submission-navigation>
            <h2 class="my-2">{{ currentSection.title }}</h2>
            <p class="lead">{{ currentSection.description }}</p>
            <div v-for="improvement in currentImprovements" class="card mb-3">
                <div class="card-header">
                    <h3 class="card-title">{{ improvement.title }}</h3>
                </div>
                <div class="card-body">
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
                return _.filter(this.improvements, (x) => {
                    return x.section_id == this.currentSectionId
                })
            }
        },
        methods: {
            changeSection(id) {
                this.currentSectionId = id
            },
            selectChoice(data) {
                let str = 'improvement.' + data.improvement + '.status';
                this.formFields[str] = data.value
            }
        }
    }
</script>
