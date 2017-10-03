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
                        :inputType="field.type">
                    </simple-text-area>
                </template>
            </div>
        </div>

    </div>
</template>

<script>
    import SimpleTextArea from '../partial/SimpleTextArea'

    export default {
        components: { SimpleTextArea },
        computed: {
            formElements() {
                return {
                    'Assessment Details': {
                        assessment_date: {
                            label: 'Assessment Date',
                            type: 'text'
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
                        }
                    }
                }
            }
        }
    }
</script>
