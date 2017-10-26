<template>
    <div class="improvement-description-vue" v-if="hasDescription">

        <button :class="getClass" type="button"
            v-on:click="toggleVisible()">
            <span v-if="visible">
                <i class="fa fa-times"></i>
            </span>
            <span v-else>
                <i class="fa fa-plus pr-2"></i> Show Description
            </span>
        </button>

        <transition name="fade">
            <template v-if="visible">
                <vue-markdown
                    :source="description">
                </vue-markdown>
            </template>
        </transition>

    </div>
</template>

<script>
    import VueMarkdown from 'vue-markdown'
    export default {
        props: ['id', 'description'],
        components: { VueMarkdown },
        computed: {
            visible() {
                return this.$store.getters.getVisible(this.id)
            },
            hasDescription() {
                return this.description.length > 0
            },
            getClass() {
                if (this.visible) {
                    return 'btn btn-warning mb-2 float-right'
                }
                return 'btn mb-4'
            }
        },
        methods: {
            toggleVisible() {
                this.$store.commit('toggleVisible', this.id)
            }
        }
    }
</script>
