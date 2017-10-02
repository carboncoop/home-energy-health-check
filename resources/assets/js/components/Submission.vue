<template>
    <div class="submission-vue" v-if="ready">

        <navigation
            :parts="parts">
        </navigation>

        <div class="my-4 container">
            <router-view
                :assessment="assessment"
                :parts="parts"
            ></router-view>

            <button class="btn btn-warning"
                v-on:click="submitForm">Submit</button>
        </div>
    </div>
</template>

<script>
    import FormMixin from '../mixins/form.js'
    import Navigation from './partial/Navigation.vue'

    export default {
        props: ['baseUrl', 'assessment', 'parts', 'improvements'],
        mixins: [FormMixin],
        components: {
            'navigation': Navigation
        },
        mounted() {
            const initImprovements = _.chain(this.improvements)
                .map(function (imp) {
                    return _.extend(imp, {value: null, comment: null})
                })
                .groupBy(function (imp) {
                    return imp.part_id
                })
                .value()
            const initParts = _.map(this.parts, (x) => {
                return _.extend(x, {improvements: initImprovements[x.id]})
            })
            this.$store.commit('init', {
                parts: initParts,
                assessment: this.assessment
            })
            this.$router.replace({ path: '/comfort' })

        },
        computed: {
            ready() {
                return this.$store.getters.ready
            }
        }
    }
</script>
