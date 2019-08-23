<template>
    <client-form :client="client" type="edit"></client-form>
</template>

<script>
    import ClientForm from './ClientForm.vue';

    export default {
        data() {
            return {
                client: Object.assign({}, this.data.client),
            }
        },
        components: {
            'client-form': ClientForm
        },
        props: ['data'],

        created() {
            this.$on('form.submitted', function () {
                events.$emit('client.updated');

                flash(trans('admin.Kunden erfolgreich bearbeitet.'));

                this.$parent.$emit('close')
            })
        }
    }
</script>