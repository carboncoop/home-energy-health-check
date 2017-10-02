<template>
    <div class="action-plan-section-vue">

        <h1 class="my-3">{{ currentPart.title }}</h1>
        <p class="lead mb-5">{{ currentPart.description }}</p>

        <div class="improvement-card card mb-5"
            :id="'improvement-'+imp.id"
            v-for="(imp, index) in currentPart.improvements">

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
                    :partIndex="currentPartIndex"
                    :improvementIndex="index"
                ></improvement-comment>

            </div>

            <div class="card-footer">
                <improvement-buttons
                    :partIndex="currentPartIndex"
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
        props: ['partId', 'parts'],
        components: {
            'improvement-buttons': ImprovementButtons,
            'improvement-comment': ImprovementComment,
        },
        computed: {
            currentPart() {
                return _.find(this.parts, this.matchesPartId)
            },
            currentPartIndex() {
                return _.findIndex(this.parts, this.matchesPartId)
            }
        },
        methods: {
            matchesPartId(part) {
                return part.id == this.partId
            }
        }
    }
</script>
