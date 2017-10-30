<template>
    <div class="health-section-vue">

        <h1 class="my-3">Home Health Check</h1>

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

    export default {
        props: ['formSchema'],
        components: { SimpleTextArea },
        computed: {
            readingElements() {
                return this.formSchema.health.readingElements;
            },
            textareaElements() {
                return this.formSchema.health.textareaElements;
            }
        }
    }
</script>
