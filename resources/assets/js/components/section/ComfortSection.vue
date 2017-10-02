<template>
    <div class="comfort-section-vue">

        <h1 class="my-3">Home comfort check</h1>
        <p class="lead mb-5">To find out more about your experience of your home, because we all have different ideas around what is and isn’t
comfortable, we have a few questions for you. These questions will help the surveyor tailor any recommendations to
your needs.</p>

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
                        :label="label">
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
        components: { RateOneToFour, SimpleTextArea, ThreeWayToggle },
        computed: {
            rateOneToFours() {
                return {
                    comfort_rate_comfort: 'Comfort',
                    comfort_rate_health: 'Health',
                    comfort_rate_environment: 'Environment',
                    comfort_rate_saving_money: 'Saving Money'
                }
            },
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
            },
            otherInfo() {
                return {
                    comfort_general: 'General comfort',
                    comfort_favourite_room: 'What is your favourite room?',
                    comfort_least_loved_room: 'What is your least loved room?',
                    comfort_other_comments: 'Any other comments'
                }
            }
        }
    }
</script>
