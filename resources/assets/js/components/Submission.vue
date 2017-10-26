<template>
    <div class="submission-vue submission-edit-vue" v-if="ready">

        <navigation
            :parts="parts">
        </navigation>

        <detect-network v-on:detected-condition="detected">
        	<div slot="offline">
                <div class="container fixed-bottom">
                    <div class="alert alert-danger">
                        <strong class="text-uppercase">Warning:</strong>
                        No internet connection detected. You are currently working offline.
                    </div>
                </div>
            </div>
        </detect-network>

        <div class="my-4 container">
            <router-view
                :baseUrl="baseUrl"
                :assessment="assessment"
                :parts="parts"
                :errors="errors"
                :formSchema="formSchema"
            ></router-view>
        </div>
    </div>
</template>

<script>
    import Navigation from './partial/Navigation.vue'
    import LocalSaveMixin from '../mixins/localSave.js'
    import DetectNetwork from 'v-offline'

    export default {
        props: [
            'baseUrl', 'formSchema', 'assessment', 'parts',
            'improvements', 'assessmentImprovements', 'loadLocal'
        ],
        components: { Navigation, DetectNetwork},
        mixins: [LocalSaveMixin],
        data() {
            return {
                initPath: '/details',
                errors: [],
                onlineState: null
            }
        },
        computed: {
            ready() {
                return this.$store.getters.ready
            }
        },
        methods: {
            detected(e) {
                this.onlineState = e;
            },
            loadLocalData() {
                let assessment = _.find(this.localAssessments, {id: this.assessment.id})
                this.$store.commit('init', {
                    parts: [], // @TODO
                    assessment: assessment.data.assessment
                })
            },
            loadDatabaseData() {
                // prepare initial improvements
                const initImprovements = _.chain(this.improvements)
                    .map((imp) => {
                        let assImp = _.find(this.assessmentImprovements, function(x) {
                            return x.improvement_id == imp.id
                        })
                        let data = { value: null, comment: null }
                        if (assImp && _.has(assImp, 'value')) {
                            data.value = assImp.value
                        }
                        if (assImp && _.has(assImp, 'comment')) {
                            data.comment = assImp.comment
                        }
                        return _.extend(imp, data)
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
            }
        },
        mounted() {
            if (this.loadLocal) {
                this.loadLocalData()
            } else {
                this.loadDatabaseData()
            }
            // and load the initial view
            this.$router.replace({ path: this.initPath })
        }

    }
</script>
