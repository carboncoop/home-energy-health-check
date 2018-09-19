<template>
    <div class="row form-group my-3 three-way-toggle-vue two-way-toggle-vue">

        <div class="col-sm-4 col-form-label text-right">
            <label>{{ label }}</label>
        </div>

        <div class="col-sm-8 btn-group" role="group">
            <button type="button" :class="buttonClass(1)"
                v-on:click="attribute = 1">
                {{ helpText[0] }}
            </button>
            <button type="button" :class="buttonClass(0)"
                v-on:click="attribute = 0">
                {{ helpText[1] }}
            </button>
        </div>

    </div>
</template>

<script>
    import AttributeMixin from '../../mixins/attribute.js'

    export default {
        props: ['attributeName', 'helpText', 'label'],
        mixins: [ AttributeMixin ],
        methods: {
            buttonClass(value) {
                let str = 'btn'
                if (this.attribute == value) {
                    str += ' btn-primary active'
                } else {
                    str += ' btn-secondary'
                }
                return str
            }
        }
    }
</script>
