<template>
    <div class="misc-comments-section-vue">

        <h1 class="my-3">Comments &amp; Notes</h1>

        <div class="card my-4">
            <div class="card-header">
                <h3 class="my-3">Miscellaneous Comments</h3>
            </div>
            <div class="card-body">
                <simple-text-area
                    attributeName="misc_comments"
                    label="Miscellaneous comments or notes"
                    inputType="textarea"
                    textAreaRows="12">
                </simple-text-area>
            </div>
        </div>

        <div class="card my-4">
            <div class="card-header">
                <h3 class="my-3">Home Visit Checklist</h3>
            </div>
            <div class="card-body">
                <template v-for="(label, attrName) in formElements">
                    <simple-text-area
                        :attributeName="attrName"
                        :label="label"
                        :inputType="getType(attrName)">
                    </simple-text-area>
                </template>
            </div>
        </div>

    </div>
</template>

<script>
    import SimpleTextArea from '../partial/SimpleTextArea'

    export default {
        props: ['assessment', 'formSchema'],
        components: { SimpleTextArea },
        computed: {
            formElements() {
                return this.formSchema.checklist
            }
        },
        methods: {
            getType(attrName) {
                if (attrName == 'checklist_further_visit') {
                    return "boolean"
                }
                return "textarea"
            }
        }
    }
</script>
