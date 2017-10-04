/**
 * == implements:
 * formData
 * respondToSuccess
 * respondToFailure
 */

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
                    this.respondToSuccess(response.data);
                    resolve(response.data);
                }).catch(error => {
                    this.respondToFailure(error.response.data);
                    reject(error.response.data);
                });
            });
        }
    }
}
