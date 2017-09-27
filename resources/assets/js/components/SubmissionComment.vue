<template>
    <div class="submission-comment-vue">
        <textarea :placeholder="improvement.assessor_comment"
            v-model="comment"
            class="form-control">
        </textarea>
    </div>
</template>

<script>
    export default {
        props: ['improvement', 'improvementIndex', 'sectionIndex'],
        computed: {
            comment: {
                get() {
                    return this.$store.getters.getComment
                },
                set(comment) {
                    this.storeComment(comment)
                }
            }
        },
        methods: {
            storeComment: _.debounce(function (comment) {
                this.$store.commit('setComment', {
                    'section_index': this.sectionIndex,
                    'improvement_index': this.improvementIndex,
                    'comment': comment,
                })
            }, 500)
        }
    }
</script>
