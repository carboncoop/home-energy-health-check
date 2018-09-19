<template>
    <div class="priority-work-section-vue">

        <h1 class="my-3">Priority Work</h1>

        <template v-for="(fields, legend) in priortyWorkElements">
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

    </div>
</template>

<script>
    import SimpleTextArea from '../partial/SimpleTextArea.vue'
    import YesNoToggle from '../partial/YesNoToggle.vue'

    export default {
        props: ['formSchema'],
        components: { SimpleTextArea, YesNoToggle },
        computed: {
            priortyWorkElements() {
                return this.formSchema.priorityWork;
            },
        }
    }
</script>
