<template>
    <div class="submit-section-vue">

        <p class="lead">
            If you wish to save your changes and return to the home page, use the following link.
        </p>

        <button class="btn btn-warning mb-3"
            v-on:click="submitEditForm(false)">Save and Quit</button>

        <p class="lead">
            If this assessment is complete and you wish to start the submission process, use the following link.
        </p>

        <div class="alert alert-warning" v-if="assessment.submitted">
            This assessment has already been submitted. Are you sure you want to do it again?
        </div>

        <button class="btn btn-danger mb-3"
            v-on:click="submitEditForm(true)">Submit</button>

        <template v-if="successful">
            <div class="alert alert-success">
                Assessment saved successfully. Returning home...
            </div>
        </template>

        <template v-if="unsuccessful">
            <div class="alert alert-danger">
                {{ errors.message }}
            </div>
            <div class="alert alert-warning" v-for="(msgs, key) in errors.errors">
                {{ key }}
                <template v-for="msg in msgs">
                    {{ msg }}
                </template>
            </div>
        </template>

    </div>
</template>

<script>
    import FormMixin from '../../mixins/form.js'

    export default {
        props: ['assessment', 'baseUrl'],
        mixins: [FormMixin],
        data() {
            return {
                submitAvailable: true,
                successful: false,
                unsuccessful: false,
                errors: []
            }
        },
        computed: {
            completedParts() {
                return this.$store.getters.getCompletedParts
            },
            completedImprovements() {
                return this.$store.getters.getCompletedImprovements
            }
        },
        methods: {
            respondToSuccess(data) {
                this.successful = true
                this.unsuccessful = false
                setTimeout(() => {
                  window.location.replace(this.baseUrl)
                }, 2000)
            },
            respondToFailure(errors) {
                this.successful = false
                this.unsuccessful = true
                this.errors = errors
                this.$emit('formErrors', errors)
            }
        }
    }
</script>
