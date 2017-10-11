<template>
    <div class="submission-vue submission-create-vue">

        <div class="container mb-4">
            <h1 class="display-4">Create a new assessment</h1>
            <p class="lead">This will be stored for later use by an assessor.</p>

            <details-section
            ></details-section>

            <button class="btn btn-danger mb-3"
                v-on:click="submitCreateForm()">Save and Finish</button>
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
        methods: {
            respondToSuccess(data) {
                this.success = data
                this.errors = null
            },
            respondToFailure(errors) {
                this.success = null
                this.errors = errors
            }
        }
    }
</script>
