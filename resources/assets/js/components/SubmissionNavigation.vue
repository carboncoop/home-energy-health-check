<template>
    <nav class="navbar navbar-expand-md fixed-top">
        <div class="container d-flex flex-column">

            <div class="navbar-collapse mb-2">
                <ul class="nav nav-tabs" v-if="sections">
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
                    <li class="nav-item">
                        <a :class="linkClass('details')" href="#details"
                            v-on:click="clickSection('details')">
                            <span class="pl-1">Details</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a :class="linkClass('homeComfort')" href="#homeComfort"
                            v-on:click="clickSection('homeComfort')">
                            <span class="pl-1">Home Comfort</span>
                        </a>
                    </li>
                </ul>
            </div>

            <div class="collapse navbar-collapse">
                <ul class="nav nav-pills" v-if="improvements">
                    <li v-for="(imp, index) in improvements" class="nav-item">
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
                <ul class="nav nav-pills" v-if="!improvements">
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
