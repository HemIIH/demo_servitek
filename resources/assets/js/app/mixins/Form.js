export default {
    data() {
        return {
            errors: {}
        }
    },

    methods: {
        submitForm(event) {
            let form = event.target;
            let action = form.action;
            let formData = new FormData(form);

            axios.post(action, formData).then((response) => {
                this.$emit('form.submitted', form);

                if (response.data.message) {
                    flash(response.data.message, response.data.level);
                }

                this.errors = {};
            }).catch((error) => {
                if (error.response.status === 422) {
                    this.errors = error.response.data;
                }
            });
        },

        validateForm(event) {
            let form = event.target;
            let action = form.action;
            let formData = new FormData(form);

            axios.post(action, formData).then(() => {
                form.submit();
            }).catch((error) => {
                if (error.response.status === 422) {
                    this.errors = error.response.data;
                }
            });
        },

        clearError(field) {
            if (field && this.errors[field]) {
                this.errors[field] = '';

                return;
            }
        }
    }
}