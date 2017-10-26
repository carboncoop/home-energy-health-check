<template>
    <div class="locally-saved-assessments-vue">
        <template v-if="haveLocalAssessments">
            <h4 class="text-uppercase">Locally saved Assessments:</h4>
            <div v-for="local in localAssessments">
                <div class="card my-2">
                    {{ local.id }} {{ local.data.assessment.homeowner_name }}
                </div>
            </div>
        </template>
    </div>
</template>

<script>
    import LocalSaveMixin from 'mixins/localSave.js'

    export default {
        mixins: [LocalSaveMixin],
        computed: {
            haveLocalAssessments() {
                return !_.isEmpty(this.localAssessments)
            },
            localAssessments() {
                return this.$localStorage.savedAssessments
            }
        }
    }
</script>
