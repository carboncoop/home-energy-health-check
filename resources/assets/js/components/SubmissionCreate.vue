<template>
    <div class="submission-vue submission-create-vue">

        <div class="container mb-4">
            <h1 class="display-4">Create a new assessment</h1>
            <p class="lead">This will be stored for later use by an assessor.</p>

            <details-section
                :errors="errors"
            ></details-section>

            <button class="btn btn-danger mb-3"
                v-on:click="submitCreateForm()">Save and Finish</button>

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
                errors: []
            }
        },
        methods: {
            respondToSuccess(data) {
                this.unsuccessful = false
                this.successful = true
                setTimeout(() => {
                  window.location.replace(this.baseUrl)
                }, 2000)
            },
            respondToFailure(errors) {
                this.unsuccessful = true
                this.successful = false
                this.errors = errors
                console.warn(errors)
            }
        }
    }
</script>
