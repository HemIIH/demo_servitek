<template>
    <div>
        <div class="row margin-b-10">
            <div class="col-md-6">
                <div v-if="order.status == 'canceled'" class="label label-warning margin-l-10">{{trans('admin.Storniert')}}</div>
            </div>
        </div>

        <div>
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label>{{trans('admin.Veranstaltungsname')}}</label>
                            <p>{{ order.title }}</p>
                        </div>
                        <div class="col-md-4 form-group">
                            <label>{{trans('admin.Benötigte Mitarbeiter')}}</label>
                            <p>{{ order.staff_required }}</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3 form-group">
                            <label>{{trans('admin.Beginn')}}</label>
                            <p>{{ moment(order.start_date).format('L') }}</p>
                        </div>
                        <div class="col-md-3 form-group">
                            <label>{{trans('admin.Ende')}}</label>
                            <p>{{ moment(order.end_date).format('L') }}</p>
                        </div>
                        <div class="col-md-3 form-group">
                            <label>{{trans('admin.Startzeit')}}</label>
                            <p>{{ order.start_time ? order.start_time + trans('admin.Uhr') : '-' }}</p>
                        </div>
                        <div class="col-md-3 form-group">
                            <label>{{trans('admin.Endzeit')}}</label>
                            <p>{{ order.end_time ? order.end_time + trans('admin.Uhr') : '-' }}</p>
                        </div>
                    </div>

                    <hr>

                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label>{{trans('admin.Einsatzort')}}</label>
                            <p>{{ order.work_location }}</p>
                        </div>
                        <div class="col-md-6 form-group">
                            <label>{{trans('admin.Einsatzinfos')}}</label>
                            <p>{{ order.requirements }}</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="pull-right">
                <a v-if="moment(order.start_date).format('L') > moment().add(4, 'days').format('L')" @click.prevent="cancelOrder" class="btn btn-warning btn-md">{{trans('admin.Stornieren')}}</a>
                <a v-if="moment(order.start_date).format('L') > moment().add(4, 'days').format('L')" @click.prevent="editOrder" class="btn btn-success btn-md">{{trans('admin.Auftrag ändern')}}</a>
                <a @click.prevent="$parent.$emit('close')" class="btn btn-danger btn-md">{{trans('admin.Schliessen')}}</a>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                order: Object.assign({}, this.data.order)
            }
        },
        props: ['data'],

        methods: {

            editOrder() {
                modal('Edit Order Modal', trans('Auftrag ändern'), {order: this.data.order});
            }

        }

    }
</script>