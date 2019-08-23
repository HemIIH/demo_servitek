<template></template>

<script>
    export default {
        props: ['message', 'type'],
        data() {
            return {
                title: '',
                body: this.message,
                level: this.type ? this.type : 'success'
            }
        },
        watch : {
            message: () => {
                this.flash();
            }
        },
        methods: {
            flash(data) {
                if (data) {
                    this.body = data.message;
                    this.level = data.level;
                }

                swal({
                    type: this.level,
                    text: this.body,
                    timer: 2000,
                    showConfirmButton:false,
                    showCancelButton: false,
                })
            }
        },
        created() {
            if (this.message) {
                this.flash();
            }

            events.$on('flash', data => this.flash(data));
            events.$on('ask', data => this.confirm(data));
        }
    };
</script>
