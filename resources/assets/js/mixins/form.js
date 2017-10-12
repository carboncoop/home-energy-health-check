/**
 * == implements:
 * respondToSuccess
 * respondToFailure
 */

export default {
    computed: {
        editFormData() {
            return this.$store.getters.getEditFormData
        },
        createFormData() {
            return this.$store.getters.getCreateFormData
        }
    },
    methods: {
        submitEditForm(andProcess = false) {
            if (this.submitAvailable) {
                this.submitAvailable = false
                let data = this.editFormData
                let url = this.baseUrl + '/submit/' + this.assessment.id
                data.andProcess = andProcess
                this.submitHttp('put', url, data)
            } else {
                console.log("Already editing, please wait.")
            }
        },
        submitCreateForm() {
            if (this.submitAvailable) {
                this.submitAvailable = false
                let data = this.createFormData
                let url = this.baseUrl + '/submit/'
                data.andProcess = false
                this.submitHttp('put', url, data)
            } else {
                console.log("Already creating, please wait.")
            }

        },
        submitHttp(requestType, url, data = {}) {
            return new Promise((resolve, reject) => {
                axios[requestType](url, data).then(response => {
                    this.respondToSuccess(response.data);
                    resolve(response.data);
                }).catch(error => {
                    this.submitAvailable = true
                    this.respondToFailure(error.response.data);
                    reject(error.response.data);
                });
            });
        }
    }
}
