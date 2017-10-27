<template>
    <div class="misc-comments-section-vue">

        <h1 class="my-3">Miscellaneous Comments</h1>

        <div class="card my-4">
            <div class="card-body">
                <simple-text-area
                    attributeName="misc_comments"
                    label="Miscellaneous comments or notes"
                    inputType="textarea"
                    textAreaRows="12">
                </simple-text-area>
            </div>
        </div>

    </div>
</template>

<script>
    import SimpleTextArea from '../partial/SimpleTextArea'

    export default {
        props: ['assessment'],
        components: { SimpleTextArea }
    }
</script>
