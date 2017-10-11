<template>
    <div class="submit-section-vue">

        <p class="lead">{{ blurb }}</p>

        <button class="btn btn-danger mb-3"
            v-on:click="submitEditForm(true)">Submit</button>

        <button class="btn btn-primary mb-3"
            v-on:click="submitEditForm(false)">Save</button>

        <template v-if="success">
            <h1>Yey, that worked.</h1>
            <small><pre class="pre-scrollable">{{ success }}</pre></small>
        </template>

        <template v-if="errors">
            <div class="alert alert-danger">
                {{ errors.message }}
            </div>
            <div class="alert alert-warning" v-for="error in errors.errors">
                {{ error }}
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
                blurb: 'Are you sure you want to submit this form now? etc..',
                success: null,
                errors: null
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
