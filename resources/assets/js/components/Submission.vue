<template>
    <div class="my-4 container">
        <h2>{{ current_section.title }}</h2>
        <p>{{ current_section.description }}</p>
        <div v-for="improvement in current_improvements">
            <h3>{{ improvement.title }}</h3>
        </div>
    </div>
</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted. '+this.sections)
        },
        props: ['sections', 'improvements'],
        data() {
            return {
                current_section_id: 1
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
        }
    }
</script>
