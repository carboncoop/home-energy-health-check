<template>
    <div class="submit-section-vue">

        <p class="lead">{{ blurb }}</p>

        <button class="btn btn-danger"
            v-on:click="submitForm">Submit</button>

    </div>
</template>

<script>
    import FormMixin from '../../mixins/form.js'

    export default {
        props: ['assessment'],
        mixins: [FormMixin],
        data() {
            return {
                blurb: 'Are you sure you want to submit this form now? etc..'
            }
        },
        computed: {
            completedParts() {
                return this.$store.getters.getCompletedParts
            },
            completedImprovements() {
                return this.$store.getters.getCompletedImprovements
            }
        }
    }
</script>
