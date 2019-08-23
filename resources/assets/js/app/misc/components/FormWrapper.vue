<template>
    <form @submit.prevent="submitForm" method="POST" @keyup="clearError($event.target.name)">
        <slot :errors="errors" :loading="loading"></slot>
    </form>
</template>

<script>
    export default {
        data() {
            return {
                errors: {},
                loading: false
            }
        },

        props: ['action'],

        methods: {
            submitForm(event) {
                this.loading = true;

                let form = event.target;
                let formData = new FormData(form);

                axios.post(this.action, formData).then((response) => {
                    this.$parent.$emit('form.submitted', form);

                    if (response.data.message) {
                        flash(response.data.message, response.data.level);
                    }

                    this.errors = {};

                    this.loading = false;
                }).catch((error) => {
                    if (error.response.status === 422) {

                        let errors = error.response.data.errors;

                        for (let key in errors) {
                            errors[key] = errors[key][0]
                        }

                        this.errors = errors;
                    }

                    this.loading = false;
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
</script>
