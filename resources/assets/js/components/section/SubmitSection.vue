<template>
    <div class="submit-section-vue">

        <p class="lead">{{ blurb }}</p>

        <button class="btn btn-danger"
            v-on:click="submitForm(true)">Submit</button>

        <button class="btn btn-primary"
            v-on:click="submitForm(false)">Save</button>

    </div>
</template>

<script>
    import FormMixin from '../../mixins/form.js'

    export default {
        props: ['assessment', 'baseUrl'],
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
