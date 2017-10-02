<template>
    <div class="submission-details-vue">

        <div class="card my-4">
            <div class="card-header">
                <h3 class="my-3">Assessment Details</h3>
            </div>
            <div class="card-body">
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Assessor Name</label>
                    <div class="col-sm-9">
                        <input class="form-control" v-model="assessment.assessor_name">
                    </div>
                </div>
            </div>
        </div>

        <div class="card my-4">
            <div class="card-header">
                <h3 class="my-3">Homeowner Details</h3>
            </div>
            <div class="card-body">
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Name</label>
                    <div class="col-sm-9">
                        <input class="form-control" v-model="assessment.homeowner_name">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Email</label>
                    <div class="col-sm-9">
                        <input class="form-control" v-model="assessment.homeowner_email">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Phone</label>
                    <div class="col-sm-9">
                        <input class="form-control" v-model="assessment.homeowner_phone">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Address</label>
                    <div class="col-sm-9">
                        <textarea class="form-control" rows="4"
                        v-model="assessment.homeowner_address"></textarea>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Home Type</label>
                    <div class="col-sm-9">
                        <input class="form-control" v-model="assessment.home_type">
                    </div>
                </div>
            </div>
        </div>

    </div>
</template>

<script>
    export default {

    }
</script>
