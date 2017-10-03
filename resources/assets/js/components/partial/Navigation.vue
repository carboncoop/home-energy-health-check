<template>
    <nav class="navbar navbar-expand-md fixed-top">
        <div class="container d-flex flex-column">

            <div class="navbar-collapse mb-2">
                <ul class="nav nav-tabs" v-if="parts">
                    <li v-for="(part, index) in parts" class="nav-item">
                        <router-link :to="'/part/'+(index + 1)"
                            class="nav-link">
                            <i v-if="completedParts[index]"
                                class="fa fa-check-square-o"
                                aria-hidden="true"></i>
                            <i v-else
                                class="fa fa-square-o"
                                aria-hidden="true"></i>
                            <span class="pl-1">Part {{ index + 1 }}</span>
                        </router-link>
                    </li>
                    <li class="nav-item">
                        <router-link to="/details" class="nav-link">
                            <span class="pl-1">Details</span>
                        </router-link>
                    </li>
                    <li class="nav-item">
                        <router-link to="/comfort" class="nav-link">
                            <span class="pl-1">Comfort</span>
                        </router-link>
                    </li>
                </ul>
            </div>

            <div class="collapse navbar-collapse">
                <ul class="nav nav-pills" v-if="currentPart">
                    <li v-for="(imp, index) in currentPart.improvements" class="nav-item">
                        <a :class="'nav-link nav-'+imp.value"
                            :href="'#part-'+imp.part_id">
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
                <ul class="nav nav-pills" v-if="!currentPart">
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
        props: ['parts'],
        computed: {
            completedParts() {
                return this.$store.getters.completedParts
            },
            currentPart() {
                return _.find(this.parts, this.matchesPartId)
            }
        },
        methods: {
            matchesPartId(part) {
                return part.id == this.$route.params.partId
            }
        }
    }
</script>
