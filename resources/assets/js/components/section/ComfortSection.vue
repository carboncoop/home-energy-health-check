<template>
    <div class="comfort-section-vue">

        <div v-for="field in threeWayToggles">
            <three-way-toggle
                :attributeName="field">
            </three-way-toggle>
        </div>

    </div>
</template>

<script>
    import ThreeWayToggle from '../partial/ThreeWayToggle'

    export default {
        components: { 'three-way-toggle': ThreeWayToggle },
        computed: {
            threeWayToggles() {
                return [
                    'comfort_rate_temperature_summer',
                    'comfort_rate_temperature_winter',
                    'comfort_rate_humidity_summer',
                    'comfort_rate_humidity_winter',
                    'comfort_rate_airflow_summer',
                    'comfort_rate_airflow_winter',
                    'comfort_rate_natural_light',
                    'comfort_rate_artificial_light',
                    'comfort_rate_noise_levels'
                ]
            }
        }
    }
</script>
