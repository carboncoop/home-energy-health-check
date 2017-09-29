<template>
    <nav class="navbar navbar-expand-md fixed-top">
        <div class="container d-flex flex-column">

            <div class="navbar-collapse mb-2">
                <ul class="nav nav-tabs" v-if="sections">
                    <li v-for="(section, index) in sections" class="nav-item">
                        <router-link :to="'/section/'+(index + 1)"
                            :class="linkClass(index)">
                            <i v-if="completedSections[index]"
                                class="fa fa-check-square-o"
                                aria-hidden="true"></i>
                            <i v-else
                                class="fa fa-square-o"
                                aria-hidden="true"></i>
                            <span class="pl-1">Part {{ index + 1 }}</span>
                        </router-link>
                    </li>
                    <li class="nav-item">
                        <router-link to="/details" :class="linkClass('details')">
                            <span class="pl-1">Details</span>
                        </router-link>
                    </li>
                    <li class="nav-item">
                        <router-link to="/comfort" :class="linkClass('comfort')">
                            <span class="pl-1">Comfort</span>
                        </router-link>
                    </li>
                </ul>
            </div>

            <div class="collapse navbar-collapse">
                <ul class="nav nav-pills" v-if="currentSection">
                    <li v-for="(imp, index) in currentSection.improvements" class="nav-item">
                        <a :class="'nav-link nav-'+imp.value"
                            :href="'#section-'+imp.section_id">
                            {{ index + 1 }}
                            <i v-if="imp.value == 'have'"
                                class="fa fa-check-circle"
                                aria-hidden="true"></i>
                            <i v-else-if="imp.value == 'need'"
                                class="fa fa-exclamation-circle"
                                aria-hidden="true"></i>
                            <i v-else
                                class="fa fa-circle-o"
                                aria-hidden="true"></i>
                        </a>
                    </li>
                </ul>
                <ul class="nav nav-pills" v-if="!currentSection">
                    <li class="nav-link">
                        <span class="nav-text">&nbsp;</span>
                    </li>
                </ul>
            </div>

        </div>
    </nav>
</template>

<script>
    export default {
        props: ['sections'],
        computed: {
            completedSections() {
                return this.$store.getters.completedSections
            },
            currentSection() {
                return _.find(this.sections, this.matchesSectionId)
            }
        },
        methods: {
            linkClass(index) {
                if (this.currentSectionIndex == index) {
                    return 'nav-link active'
                } else {
                    return 'nav-link'
                }
            },
            matchesSectionId(section) {
                return section.id == this.$route.params.sectionId
            }
        }
    }
</script>
