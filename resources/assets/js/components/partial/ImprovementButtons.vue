<template>
    <div class="row my-3 improvement-buttons-vue">
        <div v-for="(choice, index) in possibleValues" class="col col-sm-4 my-2 text-center">
            <button :class="buttonClass(choice)"
                v-on:click="clickButton(choice)">
                <span v-if="choice == 'n/a'">
                    Not applicable
                </span>
                <span v-else-if="choice == 'need'">
                    Something to Consider
                </span>
                <span v-else>
                    Something you have
                </span>
                <i v-if="value == choice && value == 'have'"
                    class="pl-2 fa fa-lg fa-check-circle" aria-hidden="true"></i>
                <i v-else-if="value == choice && value == 'need' "
                    class="pl-2 fa fa-lg fa-exclamation-circle" aria-hidden="true"></i>
                <i v-else-if="value == choice && value =='n/a'"
                    class="pl-2 fa fa-lg fa-times-circle" aria-hidden="true"></i>
                <i v-else
                    class="pl-2 fa fa-lg fa-circle-o" aria-hidden="true"></i>
            </button>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['partIndex', 'improvementIndex'],
        data() {
            return {
                possibleValues: ['have', 'need', 'n/a']
            }
        },
        computed: {
            value() {
                return this.$store.getters.getValue({
                    part_index: this.partIndex,
                    improvement_index: this.improvementIndex
                })
            }
        },
        methods: {
            clickButton(value) {
                this.$store.commit('setValue', {
                    'part_index': this.partIndex,
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
                    str += " btn-danger"
                }
                if (value == 'n/a') {
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
