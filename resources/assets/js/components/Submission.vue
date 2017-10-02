<template>
    <div class="submission-vue" v-if="ready">

        <navigation
            :sections="sections">
        </navigation>

        <div class="my-4 container">
            <router-view
                :assessment="assessment"
                :sections="sections"
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
        props: ['baseUrl', 'assessment', 'sections', 'improvements'],
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
                    return imp.section_id
                })
                .value()
            const initSections = _.map(this.sections, (x) => {
                return _.extend(x, {improvements: initImprovements[x.id]})
            })
            this.$store.commit('init', {
                sections: initSections,
                assessment: this.assessment
            })
            this.$router.replace({ path: '/section/1' })

        },
        computed: {
            ready() {
                return this.$store.getters.ready
            }
        }
    }
</script>
