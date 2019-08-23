<template>
    <div class="pointer" :class="getBackground()" @click="showOrder">
        <div class="margin-5 margin-l-10">
            <div>
                <strong :title="order.title">{{ shorten(order.client.short_name, 15) }}</strong>
            </div>
            <div class="margin-t-5"><u>{{trans('admin.Treffpunkt')}}</u></div>
            <i class="fa fa-clock-o"></i> {{ order.meeting_time }} {{trans('admin.Uhr')}} <br>
            <i class="fa fa-map-marker" :title="order.meeting_point"></i> {{ shorten(order.meeting_point, 20) }}
        </div>
    </div>
</template>

<script>
    export default {
        props: ['order'],

        methods: {
            showOrder() {
                modal('Show Order Modal', trans('admin.Auftrag anzeigen'), {'order': this.order});
            },

            getBackground(){
                if (this.order.status == 'canceled') {
                    return 'bg-yellow';
                } else if (this.order.pivot.approved_by_employee) {
                    return 'bg-green';
                } else if (this.order.pivot.rejected_by_employee) {
                    return 'bg-red';
                } else {
                    return 'bg-grey-light';
                }
            }
        }
    }
</script>