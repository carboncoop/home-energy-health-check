<template>
    <div class="action-plan-section-vue">

        <h1 class="my-3">{{ currentSection.title }}</h1>
        <p class="lead mb-5">{{ currentSection.description }}</p>

        <div class="improvement-card card mb-5"
            :id="'improvement-'+imp.id"
            v-for="(imp, index) in currentSection.improvements">

            <div class="card-body">

                <h2 class="card-title">
                    <span class="badge badge-secondary improvement-no mr-3">
                        {{ index + 1 }}
                    </span>
                    {{ imp.title }}
                </h2>

                <p>{{ imp.description }}</p>

                <div v-if="imp.assessor_guidance" class="alert alert-danger">
                    <span>{{ imp.assessor_guidance }}</span>
                </div>

                <improvement-comment
                    :improvement="imp"
                    :sectionIndex="currentSectionIndex"
                    :improvementIndex="index"
                ></improvement-comment>

            </div>

            <div class="card-footer">
                <improvement-buttons
                    :sectionIndex="currentSectionIndex"
                    :improvementIndex="index">
                </improvement-buttons>
            </div>

        </div>

    </div>
</template>

<script>
    import ImprovementButtons from '../partial/ImprovementButtons.vue'
    import ImprovementComment from '../partial/ImprovementComment.vue'

    export default {
        props: ['sectionId', 'sections'],
        components: {
            'improvement-buttons': ImprovementButtons,
            'improvement-comment': ImprovementComment,
        },
        computed: {
            currentSection() {
                return _.find(this.sections, this.matchesSectionId)
            },
            currentSectionIndex() {
                return _.findIndex(this.sections, this.matchesSectionId)
            }
        },
        methods: {
            matchesSectionId(section) {
                return section.id == this.sectionId
            }
        }
    }
</script>
