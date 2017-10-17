<template>
    <div class="action-plan-section-vue">

        <h1 class="my-3">{{ currentPart.title }}</h1>
        <div class="lead">
            <vue-markdown>{{ currentPart.description }}</vue-markdown>
        </div>

        <div class="improvement-card card mb-5"
            :id="'improvement-'+imp.id"
            v-for="(imp, index) in currentPart.improvements">

            <div class="card-header">
                <h3 class="my-3">
                    <span class="badge improvement-no mr-3">
                        {{ index + 1 }}
                    </span>
                    {{ imp.title }}
                </h3>
            </div>

            <div class="card-body">

                <vue-markdown>{{ imp.description }}</vue-markdown>

                <div v-if="imp.assessor_guidance" class="alert alert-warning">
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
    import VueMarkdown from 'vue-markdown'

    export default {
        props: ['partId', 'parts'],
        components: { ImprovementButtons, ImprovementComment, VueMarkdown },
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
