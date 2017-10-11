<template>
    <div class="row form-group my-3 simple-text-area-vue">

        <label class="col-sm-4 col-form-label text-right">
            {{ label }}
        </label>

        <div class="col-sm-8" v-if="'textarea' == inputType">
            <textarea class="form-control" v-model="attribute" rows="4">
            </textarea>
        </div>

        <div class="col-sm-8" v-if="'text' == inputType">
            <input class="form-control" v-model="attribute">
        </div>

    </div>
</template>

<script>
    import AttributeMixin from '../../mixins/attribute.js'

    export default {
        props: ['attributeName', 'label', 'inputType'],
        mixins: [ AttributeMixin ]
    }
</script>
