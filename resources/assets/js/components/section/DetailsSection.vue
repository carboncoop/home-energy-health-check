<template>
    <div class="details-section-vue">

        <div class="card my-4" v-for="(fields, legend) in formElements">
            <div class="card-header">
                <h3 class="my-3">{{ legend }}</h3>
            </div>
            <div class="card-body">
                <template v-for="(label, attrName) in fields">
                    <simple-text-area
                        :attributeName="attrName"
                        :label="label"
                        inputType="text">
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
                        assessor_name: 'Assessor Name'
                    },
                    'Homeowner Details': {
                        homeowner_name: 'Homeowner Name',
                        homeowner_address: 'Homeowner Address',
                        homeowner_phone: 'Homeowner Phone',
                        homeowner_email: 'Homeowner Email'
                    }
                }
            }
        }
    }
</script>
