<template>
    <div class="health-section-vue">

        <h1 class="my-3">Home Health Check</h1>

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
    export default {
        computed: {
            formElements() {
                return {

                }
            }
        }
    }
</script>
