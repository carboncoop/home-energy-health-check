<template>
    <div class="row">
        <div v-for="(choice, index) in possibleValues" class="col col-6 text-center">
            <button :class="buttonClass(choice)"
                v-on:click="clickButton(choice)">
                Something you {{ choice }}
                <i v-if="value == choice && value == 'have'"
                    class="fa fa-3 fa-check-circle" aria-hidden="true"></i>
                <i v-else-if="value == choice && value == 'need' "
                    class="fa fa-3 fa-exclamation-circle" aria-hidden="true"></i>
                <i v-else
                    class="fa fa-3 fa-circle-o" aria-hidden="true"></i>
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
