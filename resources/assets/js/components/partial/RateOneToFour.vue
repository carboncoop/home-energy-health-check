<template>
    <div class="row my-3 rate-one-to-four-vue">
        <div class="col col-4 text-right">
            <label>{{ label }}</label>
        </div>

        <div class="col col-8 btn-group" role="group">
            <button type="button" :class="buttonClass(rating)"
                v-for="rating in ratings"
                v-on:click="attribute = rating">
                <span class="lead">{{ rating }}</span>
            </button>
        </div>
    </div>
</template>

<script>
    import AttributeMixin from '../../mixins/attribute.js'

    export default {
        props: ['attributeName', 'label'],
        mixins: [ AttributeMixin ],
        computed: {
            ratings() {
                return [1,2,3,4]
            }
        },
        data() {
            return { foo: 'bar'}
        },
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
