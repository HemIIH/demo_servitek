<template>
    <input :name="name" :id="name" class="form-control input-sm" :value="value" @change="update($event)">
</template>

<script>
    export default {
        props: ['value', 'name'],

        methods: {
            update(event){
                this.$emit('input', event.target.value);

                this.$emit('dateSelected');
            }
        },

        mounted() {

            this.$nextTick(() => {

                $(this.$el).datepicker({
                    format: 'dd.mm.yyyy',
                    calendarWeeks: true,
                    autoclose: true
                }).on('changeDate', (event) => {
                    this.update(event);
                });
            });

        }
    };
</script>
