<template>
    <div class="row my-3 simple-text-area-vue">

        <label class="col col-4 text-right">
            {{ label }}
        </label>

        <div class="col col-8">
            <textarea class="form-control" v-model="attribute">
            </textarea>
        </div>

    </div>
</template>

<script>
    import AttributeMixin from '../../mixins/attribute.js'

    export default {
        props: ['attributeName', 'label'],
        mixins: [ AttributeMixin ]

    }
</script>
