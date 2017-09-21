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
        props: ['sectionIndex', 'improvementIndex'],
        data() {
            return {
                possibleValues: ['have', 'need']
            }
        },
        computed: {
            value() {
                return this.$store.getters.valueAtIndices({
                    section_index: this.sectionIndex,
                    improvement_index: this.improvementIndex
                })
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
                this.$store.commit('setValue', {
                    'section_index': this.sectionIndex,
                    'improvement_index': this.improvementIndex,
                    'value': value
                })
            }
        }
    }
</script>
