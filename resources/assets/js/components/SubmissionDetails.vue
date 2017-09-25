<template>
    <div>
        <div class="form-group">
            <label>Homeowner Email</label>
            <input class="form-control" v-model="assessment.homeowner_email">
        </div>
    </div>
</template>

<script>
    export default {
        props: ['assessment']
    }
</script>
