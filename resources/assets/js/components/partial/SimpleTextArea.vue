<template>
    <div class="simple-text-area-vue">
        <div class="row form-group my-3">

            <label class="col-sm-4 col-form-label text-right">
                {{ label }}
            </label>

            <div class="col-sm-8" v-if="'textarea' == inputType">
                <textarea class="form-control" v-model="attribute" rows="4">
                </textarea>
                <div class="mt-3 alert alert-danger" v-for="message in errors">
                    {{ message }}
                </div>
            </div>

            <div class="col-sm-8" v-if="'date' == inputType">
                <datepicker v-model="datepickerValue"
                    input-class="form-control"
                    format="D dsu MMMM yyyy"
                    placeholder="select a date »"></datepicker>
                <div class="mt-3 alert alert-danger" v-for="message in errors">
                    {{ message }}
                </div>
            </div>

            <div class="col-sm-8" v-if="'text' == inputType">
                <input class="form-control" type="text" v-model="attribute">
                <div class="mt-3 alert alert-danger" v-for="message in errors">
                    {{ message }}
                </div>
            </div>

            <div class="col-sm-8" v-if="'numeric' == inputType">
                <input class="form-control" type="number" v-model="attribute">
                <div class="mt-3 alert alert-danger" v-for="message in errors">
                    {{ message }}
                </div>
            </div>

        </div>
    </div>
</template>

<script>
    import AttributeMixin from '../../mixins/attribute.js'
    import Datepicker from 'vuejs-datepicker'
    import Moment from 'moment'

    export default {
        props: ['attributeName', 'label', 'inputType', 'errors'],
        components: { Datepicker },
        mixins: [ AttributeMixin ],
        computed: {
            datepickerValue: {
                get() {
                    return this.attribute
                },
                set(value) {
                    let str = Moment(value).format("YYYY-MM-DD")
                    this.attribute = str
                }
            }
        }
    }
</script>
