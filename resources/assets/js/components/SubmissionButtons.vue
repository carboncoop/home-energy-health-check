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
        props: ['sectionId', 'improvementId'],
        data() {
            return {
                possibleValues: ['have', 'need']
            }
        },
        computed: {
            value() {
                return this.$store.getters.getValue({
                    section_id: this.sectionId,
                    improvement_id: this.improvementId
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
                this.$store.commit('selectChoice', {
                    'section_id': this.sectionId,
                    'improvement_id': this.improvementId,
                    'value': value
                })
            }
        }
    }
</script>
