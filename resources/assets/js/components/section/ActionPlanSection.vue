<template>
    <div class="action-plan-section-vue">

        <h1 class="my-3">{{ currentPart.title }}</h1>
        <div class="lead">
            <vue-markdown
                v-bind:source="currentPart.description">
            </vue-markdown>
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
                <improvement-description
                    :id="imp.id"
                    :description="imp.description">
                </improvement-description>

                <div class="row row-eq-height" v-if="imp.assessor_guidance">
                    <div class="col-12 col-sm-5">
                        <div class="alert alert-warning">
                            <span>{{ imp.assessor_guidance }}</span>
                        </div>
                    </div>
                    <div class="col-12 col-sm-7" v-if="showAssessorsComments(imp, index)">
                        <improvement-comment
                            :improvement="imp"
                            :partIndex="currentPartIndex"
                            :improvementIndex="index"
                        ></improvement-comment>
                    </div>
                </div>
                <div v-else>
                    <template v-if="showAssessorsComments(imp, index)">
                        <improvement-comment
                            :improvement="imp"
                            :partIndex="currentPartIndex"
                            :improvementIndex="index"
                        ></improvement-comment>
                    </template>
                </div>

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
    import ImprovementDescription from '../partial/ImprovementDescription.vue'
    import VueMarkdown from 'vue-markdown'

    export default {
        props: ['partId', 'parts'],
        components: { ImprovementButtons, ImprovementComment, ImprovementDescription, VueMarkdown },
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
            },
            getValue(imp, index) {
                return this.$store.getters.getValue({
                    part_index: this.currentPartIndex,
                    improvement_index: index
                })
            },
            showAssessorsComments(imp, index) {
                let val = this.getValue(imp, index)
                if ('n/a' == val || 'have' == val) {
                    return false
                }
                return true
            }
        }
    }
</script>
