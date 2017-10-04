export default {
    computed: {
        formData() {
            return this.$store.getters.getFormData
        }
    },
    methods: {
        submitForm(andProcess = false) {
            let data = this.formData
            let url = this.baseUrl + '/submit/' + this.assessment.id
            data.andProcess = andProcess
            this.submitHttp('put', url, data)
        },
        submitHttp(requestType, url, data = {}) {
            return new Promise((resolve, reject) => {
                axios[requestType](url, data).then(response => {
                    this.onSuccess(response.data);
                    resolve(response.data);
                }).catch(error => {
                    this.onFail(error.response.data);
                    reject(error.response.data);
                });
            });
        },
        onSuccess(data) {
            console.warn("success", data)
        },
        onFail(errors) {
            console.warn("errors", errors)
        }
    }
}
