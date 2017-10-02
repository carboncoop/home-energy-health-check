<template>
    <div class="row my-3 improvement-buttons-vue">
        <div v-for="(choice, index) in possibleValues" class="col col-6 text-center">
            <button :class="buttonClass(choice)"
                v-on:click="clickButton(choice)">
                Something you {{ choice }}
                <i v-if="value == choice && value == 'have'"
                    class="pl-2 fa fa-lg fa-check-circle" aria-hidden="true"></i>
                <i v-else-if="value == choice && value == 'need' "
                    class="pl-2 fa fa-lg fa-exclamation-circle" aria-hidden="true"></i>
                <i v-else
                    class="pl-2 fa fa-lg fa-circle-o" aria-hidden="true"></i>
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
                return this.$store.getters.getValue({
                    section_index: this.sectionIndex,
                    improvement_index: this.improvementIndex
                })
            }
        },
        methods: {
            clickButton(value) {
                this.$store.commit('setValue', {
                    'section_index': this.sectionIndex,
                    'improvement_index': this.improvementIndex,
                    'value': value
                })
            },
            buttonClass(value) {
                let str = "btn py-2 px-4"
                str += " btn-" + value
                if (value == 'have') {
                    str += " btn-primary"
                }
                if (value == 'need') {
                    str += " btn-warning"
                }
                if (value == this.value) {
                    str += " active"
                } else {
                    str += " inactive"
                }
                return str
            }
        }
    }
</script>
