<template>
    <div class="row my-3 three-way-toggle-vue">

        <div class="col col-4 text-right">
            <label>{{ label }}</label>
        </div>

        <div class="col col-8 btn-group" role="group">
            <button type="button" :class="buttonClass(1)"
                v-on:click="attribute = 1">
                {{ helpText[0] }}
            </button>
            <button type="button" :class="buttonClass(2)"
                v-on:click="attribute = 2">
                &nbsp;.&nbsp;.&nbsp;.
            </button>
            <button type="button" :class="buttonClass(3)"
                v-on:click="attribute = 3">
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
