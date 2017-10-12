<template>
    <div class="submission-vue submission-edit-vue" v-if="ready">

        <navigation
            :parts="parts">
        </navigation>

        <div class="my-4 container">
            <router-view
                :baseUrl="baseUrl"
                :assessment="assessment"
                :parts="parts"
                :errors="errors"
            ></router-view>
        </div>
    </div>
</template>

<script>
    import Navigation from './partial/Navigation.vue'

    export default {
        props: ['baseUrl', 'assessment', 'parts', 'improvements'],
        components: { Navigation },
        data() {
            return {
                initPath: '/details',
                errors: []
            }
        },
        computed: {
            ready() {
                return this.$store.getters.ready
            }
        },
        mounted() {
            // prepare initial improvements
            const initImprovements = _.chain(this.improvements)
                .map(function (imp) {
                    return _.extend(imp, {value: null, comment: null})
                })
                .groupBy(function (imp) {
                    return imp.part_id
                })
                .value()

            // nest the improvements inside their parts
            const initParts = _.map(this.parts, (x) => {
                return _.extend(x, {improvements: initImprovements[x.id]})
            })

            // seed the store with this data
            this.$store.commit('init', {
                parts: initParts,
                assessment: this.assessment
            })

            // and load the initial view
            this.$router.replace({ path: this.initPath })
        }

    }
</script>
