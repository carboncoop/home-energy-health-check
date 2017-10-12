<template>
    <div class="submission-vue submission-create-vue">

        <div class="container mb-4">
            <h1 class="display-4">Create a new assessment</h1>
            <p class="lead">This will be stored for later use by an assessor.</p>

            <details-section
                :errors="errors"
            ></details-section>

            <button class="btn btn-danger mb-3"
                v-on:click="saveAndFinish()">Save and Finish</button>

            <div v-if="waiting" class="alert alert-info">
                I am processing your request, please wait...
            </div>

            <div class="alert alert-success" v-if="successful">
                Assessment saved successfully. Returning home...
            </div>

            <div class="alert alert-danger" v-if="unsuccessful">
                Oops, something went wrong. Please correct the errors above.
            </div>

        </div>

    </div>
</template>

<script>
    import DetailsSection from './section/DetailsSection.vue'
    import FormMixin from '../mixins/form.js'

    export default {
        props: ['baseUrl'],
        components: { DetailsSection },
        mixins: [FormMixin],
        data() {
            return {
                submitAvailable: true,
                successful: false,
                unsuccessful: false,
                waiting: false,
                errors: []
            }
        },
        methods: {
            saveAndFinish() {
                this.waiting = true
                this.submitCreateForm(false)
            },
            respondToSuccess(data) {
                this.waiting = false
                this.unsuccessful = false
                this.successful = true
                setTimeout(() => {
                  window.location.replace(this.baseUrl)
              }, 1200)
            },
            respondToFailure(errors) {
                this.waiting = false
                this.unsuccessful = true
                this.successful = false
                this.errors = errors
            }
        }
    }
</script>
