<template>
    <div class="submission-vue submission-create-vue">

        <div class="container mb-4">
            <h1 class="display-4">Create a new assessment</h1>
            <p class="lead">This will be stored for later use by an assessor.</p>

            <details-section
            ></details-section>
        </div>

    </div>
</template>

<script>
    import DetailsSection from './section/DetailsSection.vue'

    export default {
        props: ['baseUrl'],
        components: { DetailsSection }
    }
</script>
