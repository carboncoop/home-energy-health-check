<template>
    <div class="text-center">

        <button class="btn btn-primary"
            v-if="partIndex != 0"
            v-on:click="partIndex -= 1"
            >Previous Part</button>

        <button class="btn btn-primary"
            v-if="partIndex < partsLength - 1"
            v-on:click="partIndex += 1"
            >Next Part</button>

        <slot></slot>

    </div>
</template>

<script>
    export default {
        props: ['partIndex', 'partsLength']
    }
</script>
