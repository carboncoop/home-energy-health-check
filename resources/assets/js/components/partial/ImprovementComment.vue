<template>
    <div class="submission-comment-vue">
        <textarea :placeholder="improvement.assessor_comment"
            v-model="comment"
            class="form-control">
        </textarea>
    </div>
</template>

<script>
    import _ from 'lodash'

    export default {
        props: ['improvement', 'improvementIndex', 'sectionIndex'],
        computed: {
            comment: {
                get() {
                    return this.$store.getters.getComment({
                        section_index: this.sectionIndex,
                        improvement_index: this.improvementIndex
                    })
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
