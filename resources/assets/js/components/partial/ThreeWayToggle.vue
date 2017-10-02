<template>
    <div class="three-way-toggle-vue">
        <input class="form-control my-2" type="number" v-model="attribute">
    </div>
</template>

<script>
    export default {
        props: ['attributeName'],
        computed: {
            attribute: {
                get() {
                    return this.$store.getters.getAssessmentAttribute(
                        this.attributeName
                    )
                },
                set(value) {
                    this.$store.commit('setAssessmentAttribute', {
                        key: this.attributeName,
                        value: value
                    })
                }
            }
        }
    }
</script>
