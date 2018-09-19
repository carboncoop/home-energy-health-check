<template>
    <div class="health-section-vue">

        <h1 class="my-3">Home Health Check</h1>

        <template v-for="(fields, legend) in yesNoElements">
            <div class="card my-4">
                <div class="card-header">
                    <h3 class="my-3">{{ legend }}</h3>
                </div>
                <div class="card-body">
                    <div v-for="(label, attrName) in fields">
                        <yes-no-toggle
                            :attributeName="attrName + '_yn'"
                            :label="label"
                            :helpText="['Yes', 'No']">
                        </yes-no-toggle>
                        <simple-text-area
                            :attributeName="attrName + '_comment'"
                            label="Comments"
                            inputType="textarea">
                        </simple-text-area>
                    </div>
                </div>
            </div>
        </template>

        <div class="card my-4" v-for="(fields, legend) in textareaElements">
            <div class="card-header">
                <h3 class="my-3">{{ legend }}</h3>
            </div>
            <div class="card-body">
                <template v-if="'Temperature & Air Quality Readings' == legend"
                    v-for="(label, attrName) in readingElements">
                    <simple-text-area
                        :attributeName="attrName"
                        :label="label"
                        inputType="numeric">
                    </simple-text-area>
                </template>
                <template v-for="(label, attrName) in fields">
                    <simple-text-area
                        :attributeName="attrName"
                        :label="label"
                        inputType="textarea">
                    </simple-text-area>
                </template>
            </div>
        </div>

    </div>
</template>

<script>
    import SimpleTextArea from '../partial/SimpleTextArea.vue'
    import YesNoToggle from '../partial/YesNoToggle.vue'

    export default {
        props: ['formSchema'],
        components: { SimpleTextArea, YesNoToggle },
        computed: {
            yesNoElements() {
                return this.formSchema.health.yesNoElements;
            },
            readingElements() {
                return this.formSchema.health.readingElements;
            },
            textareaElements() {
                return this.formSchema.health.textareaElements;
            }
        }
    }
</script>
