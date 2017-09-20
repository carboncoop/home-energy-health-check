<template>
    <nav class="navbar fixed-top navbar-light bg-light">
        <div class="container">

            <div class="">
                <span class="navbar-text">Section:</span>
                <ul class="nav nav-pills">
                    <li v-for="section in sections" class="nav-item">
                        <a :class="linkClass(section.id)"
                            :href="'#section-'+section.id"
                            v-on:click="clickSection(section.id)">
                            {{ section.id }} {{ completedSections[section.id] }}
                        </a>
                    </li>
                </ul>
            </div>

            <div class="">
                <span class="navbar-text">Improvements:</span>
                <ul class="nav nav-pills">
                    <li v-for="improvement in improvements" class="nav-item">
                        <a class="nav-link"
                            :href="'#section-'+improvement.section_id"
                            v-on:click="clickImprovement(improvement.id, improvement.section_id)">
                            {{ improvement.id }}
                        </a>
                    </li>
                </ul>
            </div>

        </div>
    </nav>
</template>

<script>
    export default {
        props: ['sections', 'improvements', 'currentSectionId'],
        computed: {
            completedSections() {
                return _.transform(this.sections, (xs, s, k) => {
                    xs[s.id] = this.$store.getters.isSectionComplete(s.id)
                })
            }
        },
        methods: {
            clickSection(id) {
                this.$emit('changeSection', id)
            },
            clickImprovement(improvementId, sectionId) {
                //this.$emit('changeSection', sectionId)
                //$('body').scrollspy({ target: '#improvement-' + improvementId })
            },
            linkClass(id) {
                if (this.currentSectionId == id) {
                    return 'nav-link active'
                } else {
                    return 'nav-link'
                }
            }
        }
    }
</script>
