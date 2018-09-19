<template>
    <nav class="navbar fixed-top">
        <div class="container d-flex flex-column">

            <div class="navbar-top-row d-flex justify-content-between">
                <ul class="nav nav-tabs mr-auto">
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
                    <li class="nav-item">
                        <router-link to="/health" class="nav-link">
                            <span class="pl-1">Health</span>
                        </router-link>
                    </li>
                    <li class="nav-item">
                        <router-link to="/priority" class="nav-link">
                            <span class="pl-1">Priority Work</span>
                        </router-link>
                    </li>
                </ul>

                <span class="navbar-text pr-3">Action Plan:</span>

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
                            <span class="pl-1">{{ index + 1 }}</span>
                        </router-link>
                    </li>
                    <li class="nav-item">
                        <router-link to="/comments" class="nav-link">
                            Comments
                        </router-link>
                    </li>
                </ul>

                <router-link to="/submit" tag="button" class="btn btn-warning ml-3">
                    <span>Done</span>
                </router-link>

            </div>

            <div class="navbar-bottom-row d-flex justify-content-around">
                <ul class="nav nav-pills" v-if="currentPart">
                    <li v-for="(imp, index) in currentPart.improvements" class="nav-item">
                        <a :class="'nav-link nav-'+imp.value">
                            {{ index + 1 }}
                            <i v-if="imp.value == 'have'"
                                class="fa fa-check-circle"
                                aria-hidden="true"></i>
                            <i v-else-if="imp.value == 'need'"
                                class="fa fa-exclamation-circle"
                                aria-hidden="true"></i>
                            <i v-else-if="imp.value == 'n/a'"
                                class="fa fa-times-circle"
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
                return this.$store.getters.getCompletedParts
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
