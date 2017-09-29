<template>
    <div class="text-center">

        <button class="btn btn-primary"
            v-if="sectionIndex != 0"
            v-on:click="sectionIndex -= 1"
            >Previous Section</button>

        <button class="btn btn-primary"
            v-if="sectionIndex < sectionsLength - 1"
            v-on:click="sectionIndex += 1"
            >Next Section</button>

        <slot></slot>

    </div>
</template>

<script>
    export default {
        props: ['sectionIndex', 'sectionsLength']
    }
</script>
