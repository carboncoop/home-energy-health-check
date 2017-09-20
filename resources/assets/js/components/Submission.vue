<template>
    <div class="submission-vue">
        <div class="my-4 container">
            <submission-navigation :sections="sections"></submission-navigation>
            <h2 class="my-2">{{ current_section.title }}</h2>
            <p class="lead">{{ current_section.description }}</p>
            <div v-for="improvement in current_improvements" class="card mb-3">
                <div class="card-header">
                    <h3 class="card-title">{{ improvement.title }}</h3>
                </div>
                <div class="card-body">
                    <p>{{ improvement.description }}</p>
                </div>
                <div class="card-footer">
                    <div v-for="option in choice_options"
                        class="form-check form-check-inline">
                        <label :for="get_name(improvement)" class="form-check-label">
                            <input type="radio" :name="get_name(improvement)"
                                class="form-check-input"
                                value="have">
                            <button class="btn btn-primary">
                                Something you {{ option }}
                            </button>
                        </label>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import SubmissionNavigation from './SubmissionNavigation.vue'

    export default {
        components: {
            'submission-navigation': SubmissionNavigation
        },
        props: ['sections', 'improvements'],
        data() {
            return {
                current_section_id: 1,
                choice_options: ['have', 'need']
            }
        },
        computed: {
            current_section() {
                return this.sections[this.current_section_id]
            },
            current_improvements() {
                return _.filter(this.improvements, (x) => {
                    return x.section_id == this.current_section_id
                })
            }
        },
        methods: {
            get_name(improvement) {
                return "improvement." + improvement.id+ ".status"
            }
        }
    }
</script>
