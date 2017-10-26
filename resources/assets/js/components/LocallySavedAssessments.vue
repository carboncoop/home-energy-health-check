<template>
    <div class="locally-saved-assessments-vue">
        <template v-if="haveLocalAssessments">
            <h4 class="text-uppercase">Locally Saved Assessments</h4>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Assessment Date</th>
                        <th>Homeowner</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="local in localAssessments">
                        <td>{{ local.data.assessment.assessment_date }}</td>
                        <td>{{ local.data.assessment.homeowner_name }}</td>
                        <td>Saved Locally</td>
                        <td><div class="btn-group">
                            <a class="btn btn-warning" :href="baseUrl+'/submit/'+local.data.assessment.id+'/edit?loadLocal'">
                                Go to form
                            </a>
                        </div></td>
                    </tr>
                </tbody>
            </table>
        </template>
    </div>
</template>

<script>
    import LocalSaveMixin from '../mixins/localSave.js'

    export default {
        props: ['baseUrl'],
        mixins: [LocalSaveMixin],
        computed: {
            haveLocalAssessments() {
                return !_.isEmpty(this.localAssessments)
            }
        }
    }
</script>
