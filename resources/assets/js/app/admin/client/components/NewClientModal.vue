<template>
    <client-form :client="client" type="create"></client-form>
</template>

<script>
    import ClientForm from './ClientForm.vue';

    export default {
        data() {
            return {
                client: {}
            }
        },
        components: {
            'client-form': ClientForm
        },
        props: ['data'],

        created() {
            this.$on('form.submitted', function () {
                events.$emit('client.created');

                flash(trans('admin.Neuen Kunden angelegt'));

                this.$parent.$emit('close')
            })
        }
    }
</script>