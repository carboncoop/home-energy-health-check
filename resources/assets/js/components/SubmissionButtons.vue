<template>
    <div class="row">
        <div v-for="value in possibleValues" class="col col-6 text-center">
            <button :class="buttonClass(value)"
                v-on:click="clickButton(value)">
                Something you {{ value }}
            </button>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['improvementId'],
        data() {
            return {
                possibleValues: ['have', 'need'],
                value: null
            }
        },
        methods: {
            buttonClass(value) {
                let str = "btn btn-primary"
                str += " btn-" + value
                if (value == this.value) {
                    str += " active"
                }
                return str
            },
            clickButton(value) {
                this.value = value
                this.$emit('selectChoice', {
                    'improvement': this.improvementId,
                    'value': value
                })
            }
        }
    }
</script>
