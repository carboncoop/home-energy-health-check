<template>
    <div class="simple-text-area-vue">

        <div class="row form-group my-3">
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

        <div class="alert alert-danger" v-for="message in errors">
            {{ message }}
        </div>

    </div>
</template>

<script>
    import AttributeMixin from '../../mixins/attribute.js'

    export default {
        props: ['attributeName', 'label', 'inputType', 'errors'],
        mixins: [ AttributeMixin ]
    }
</script>
