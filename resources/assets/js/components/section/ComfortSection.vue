<template>
    <div class="comfort-section-vue">

        <div class="card my-4">
            <div class="card-header">
                <h3 class="my-3">Home comfort check</h3>
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

    </div>
</template>

<script>
    import ThreeWayToggle from '../partial/ThreeWayToggle'

    export default {
        components: { 'three-way-toggle': ThreeWayToggle },
        computed: {
            threeWayToggles() {
                return {
                    comfort_rate_temperature_summer: {
                        label: 'Temperature in the Summer',
                        helpText: ['Too hot', 'Too cold']
                    },
                    comfort_rate_temperature_winter: {
                        label: 'Temperature in the Winter',
                        helpText: ['Too hot', 'Too cold']
                    },
                    comfort_rate_humidity_summer: {
                        label: 'Air in the Summer',
                        helpText: ['Too dry', 'Too stuffy']
                    },
                    comfort_rate_humidity_winter: {
                        label: 'Air in the Winter',
                        helpText: ['Too dry', 'Too stuffy']
                    },
                    comfort_rate_airflow_summer: {
                        label: 'Air in the Summer',
                        helpText: ['Too draughty', 'Just right']
                    },
                    comfort_rate_airflow_winter: {
                        label: 'Air in the Winter',
                    	helpText: ['Too draughty', 'Just right']
                    },
                    comfort_rate_natural_light: {
                        label: 'Natural light',
                    	helpText: ['Too little', 'Too much']
                    },
                    comfort_rate_artificial_light: {
                        label: 'Artificial light',
                    	helpText: ['Too little', 'Too much']
                    },
                    comfort_rate_noise_levels: {
                        label: 'Noise levels',
                    	helpText: ['Too noisy', 'Too quiet']
                    }
                }
            }
        }
    }
</script>
