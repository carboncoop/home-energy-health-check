<template>
    <div class="health-section-vue">

        <h1 class="my-3">Home Health Check</h1>

        <div class="card my-4" v-for="(fields, legend) in textareaElements">
            <div class="card-header">
                <h3 class="my-3">{{ legend }}</h3>
            </div>
            <div class="card-body">
                <template v-if="'Temperature Readings' == legend"
                    v-for="(label, attrName) in readingElements">
                    <simple-text-area
                        :attributeName="attrName"
                        :label="label"
                        inputType="text">
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
        components: { SimpleTextArea },
        computed: {
            readingElements() {
                return {
                    reading_temperature_living_room: 'Temperature spot check (living room)',
                    reading_humidity_living_room: 'Relative humidity spot check (living room)',
                    reading_surface_temperature_living_room: 'Average surface temperature (living room)',
                    reading_temperature_bedroom: 'Temperature spot check (bedroom)',
                    reading_humidity_bedroom: 'Relative humidity spot check (bedroom)',
                    reading_surface_temperature_bedroom: 'Average surface temperature (bedroom)',
                    reading_air_quality: 'Air Quality Reading'
                }
            },
            textareaElements() {
                return {
                    'Temperature Readings': {
                        health_surface_temperature_notes: 'Assessor note on surface temperature. Any cold spots?'
                    },
                    'Home Health Comment': {
                        health_condensation: 'Condensation',
                        health_damp: 'Damp',
                        health_mold: 'Mold',
                        health_ventilation: 'Ventilation',
                        health_laundry: 'Laundry',
                        health_air_quality: 'Air Quality'
                    }
                }
            }
        }
    }
</script>
