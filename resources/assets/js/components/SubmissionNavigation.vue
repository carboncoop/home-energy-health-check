<template>
    <nav class="navbar fixed-top navbar-light bg-light">
        <div class="container">

            <div class="">
                <span class="navbar-text">Section:</span>
                <ul class="nav nav-pills">
                    <li v-for="(section, index) in sections" class="nav-item">
                        <a :class="linkClass(section.id)"
                            :href="'#section-'+section.id"
                            v-on:click="clickSection(index)">
                            {{ section.id }}
                            <span v-if="completedSections[index]">
                                <i class="fa fa-check-square-o" aria-hidden="true"></i>
                            </span>
                            <span v-else>
                                <i class="fa fa-square-o" aria-hidden="true"></i>
                            </span>
                        </a>
                    </li>
                </ul>
            </div>

            <div class="">
                <span class="navbar-text">Improvements:</span>
                <ul class="nav nav-pills">
                    <li v-for="improvement in improvements" class="nav-item">
                        <a class="nav-link"
                            :href="'#section-'+improvement.section_id">
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
        props: ['sections', 'improvements'],
        computed: {
            completedSections() {
                return this.$store.getters.completedSections
            }
        },
        methods: {
            clickSection(index) {
                this.$store.commit('setCurrentSection', index)
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
