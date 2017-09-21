<template>
    <nav class="navbar navbar-expand-md fixed-top">
        <div class="container d-flex flex-column">

            <div class="navbar-collapse mb-2">
                <ul class="nav nav-tabs">
                    <li v-for="(section, index) in sections" class="nav-item">
                        <a :class="linkClass(index)"
                            :href="'#section-'+section.id"
                            v-on:click="clickSection(index)">
                            <i v-if="completedSections[index]"
                                class="fa fa-check-square-o"
                                aria-hidden="true"></i>
                            <i v-else
                                class="fa fa-square-o"
                                aria-hidden="true"></i>
                            <span class="pl-1">Part {{ index + 1 }}</span>
                        </a>
                    </li>
                </ul>
            </div>

            <div class="collapse navbar-collapse">
                <ul class="nav nav-pills">
                    <li v-for="improvement in improvements" class="nav-item">
                        <a :class="'nav-link nav-'+improvement.value"
                            :href="'#section-'+improvement.section_id">
                            {{ improvement.id }}
                            <i v-if="improvement.value == 'have'"
                                class="fa fa-check-circle"
                                aria-hidden="true"></i>
                            <i v-else-if="improvement.value == 'need'"
                                class="fa fa-exclamation-circle"
                                aria-hidden="true"></i>
                            <i v-else
                                class="fa fa-circle-o"
                                aria-hidden="true"></i>
                        </a>
                    </li>
                </ul>
            </div>

        </div>
    </nav>
</template>

<script>
    export default {
        props: ['sections', 'improvements'],
        computed: {
            completedSections() {
                return this.$store.getters.completedSections
            },
            currentSectionIndex() {
                return this.$store.getters.currentSectionIndex
            }
        },
        methods: {
            clickSection(index) {
                this.$store.commit('setCurrentSection', index)
            },
            linkClass(index) {
                if (this.currentSectionIndex == index) {
                    return 'nav-link active'
                } else {
                    return 'nav-link'
                }
            }
        }
    }
</script>
