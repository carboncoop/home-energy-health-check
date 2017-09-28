export default {
    computed: {
        formData() {
            return this.$store.getters.formData
        }
    },
    methods: {
        submitForm() {
            let url = this.baseUrl + '/submit/' + this.assessment.id
            this.submitHttp('put', url, this.formData)
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
