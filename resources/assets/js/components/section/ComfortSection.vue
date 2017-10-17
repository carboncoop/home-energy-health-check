<template>
    <div class="comfort-section-vue">

        <h1 class="my-3">Home Comfort Check</h1>

        <div class="card my-4">
            <div class="card-header">
                <h3 class="my-3">What of the following is most important to you:</h3>
            </div>
            <div class="card-body">
                <p class="mb-5 font-italic">(rate 1-4, 1 being most important, 4 least important)</p>
                <template v-for="(label, attrName) in rateOneToFours">
                    <rate-one-to-four
                        :attributeName="attrName"
                        :label="label">
                    </rate-one-to-four>
                </template>
            </div>
        </div>

        <div class="card my-4">
            <div class="card-header">
                <h3 class="my-3">How do you find your home?</h3>
            </div>
            <div class="card-body">
                <template v-for="(obj, attrName) in threeWayToggles">
                    <three-way-toggle
                        :attributeName="attrName"
                        :label="obj.label"
                        :helpText="obj.helpText">
                    </three-way-toggle>
                </template>
            </div>
        </div>

        <div class="card my-4">
            <div class="card-header">
                <h3 class="my-3">Other Information</h3>
            </div>
            <div class="card-body">
                <template v-for="(label, attrName) in otherInfo">
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
    import RateOneToFour from '../partial/RateOneToFour'
    import SimpleTextArea from '../partial/SimpleTextArea'
    import ThreeWayToggle from '../partial/ThreeWayToggle'

    export default {
        props: ['formSchema'],
        components: { RateOneToFour, SimpleTextArea, ThreeWayToggle },
        computed: {
            rateOneToFours() {
                return this.formSchema.comfort.rateOneToFour;
            },
            threeWayToggles() {
                return this.formSchema.comfort.threeWayToggles;
            },
            otherInfo() {
                return this.formSchema.comfort.otherInfo;
            }
        }
    }
</script>
