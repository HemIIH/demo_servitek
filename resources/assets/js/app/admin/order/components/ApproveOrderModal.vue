<template>
    <order-form
            :model="data.order"
            :action="'/api/order/' + data.order.id + '/approve'"
            type="edit"
    ></order-form>
</template>

<script>
    import OrderForm from './OrderForm.vue';

    export default {
        components: {
            'order-form' : OrderForm
        },
        props: ['data'],

        created() {
            this.$on('form.submitted', () => {
                events.$emit('order.updated');

                flash(trans('Auftrag angenommen'));

                this.$parent.$emit('close')
            })
        }

    }
</script>