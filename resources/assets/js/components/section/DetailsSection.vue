<template>
    <div class="details-section-vue">

        <h1 class="my-3">Assessment Details</h1>

        <div class="card my-4" v-for="(fields, legend) in formElements">
            <div class="card-header">
                <h3 class="my-3">{{ legend }}</h3>
            </div>
            <div class="card-body">
                <template v-for="(field, attrName) in fields">
                    <simple-text-area
                        :attributeName="attrName"
                        :label="field.label"
                        :inputType="field.type"
                        :errors="findError(attrName)">
                    </simple-text-area>
                </template>
            </div>
        </div>

    </div>
</template>

<script>
    import SimpleTextArea from '../partial/SimpleTextArea'

    export default {
        props: ['errors'],
        components: { SimpleTextArea },
        methods: {
            findError(key) {
                let slug = 'assessment.'+key
                if (_.has(this.errors.errors, slug)) {
                    return this.errors.errors[slug]
                }
                return false;
            }
        },
        computed: {
            formElements() {
                return {
                    'Assessment Details': {
                        assessment_date: {
                            label: 'Assessment Date',
                            type: 'date'
                        },
                        assessor_name: {
                            label: 'Assessor Name',
                            type: 'text'
                        }
                    },
                    'Homeowner Details': {
                        homeowner_name: {
                            label: 'Homeowner Name',
                            type: 'text'
                        },
                        homeowner_address: {
                            label: 'Homeowner Address',
                            type: 'textarea'
                        },
                        homeowner_phone: {
                            label: 'Homeowner Phone',
                            type: 'text'
                        },
                        homeowner_email: {
                            label: 'Homeowner Email',
                            type: 'text'
                        },
                        homeowner_uniqueid: {
                            label: 'Unique Code Identifier',
                            type: 'text'
                        }
                    }
                }
            }
        }
    }
</script>
