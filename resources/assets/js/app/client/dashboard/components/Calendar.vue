<template>
    <div class="row">
        <div class="col-md-12">
            <div class="pull-right">
                <ul class="pager list-unstyled">
                    <li>
                        <a @click="sub('weeks')">
                            <i class="fa fa-angle-left"></i>
                        </a>
                    </li>
                    <li>
                        {{trans('admin.KW')}} {{ moment(start).week() }}
                    </li>
                    <li>
                        <a @click="add('weeks')">
                            <i class="fa fa-angle-right"></i>
                        </a>
                    </li>
                </ul>
            </div>

            <br>
            <br>

            <table class="table table-fixed" id="order-calendar">
                <thead>
                <tr class="bg-grey-light">
                    <th v-for="(weekday, date) in week">
                        {{ weekday + ', ' + moment(date).format('l') }}
                    </th>
                </tr>
                </thead>
                <tbody>
                <tr height="300px">
                    <td v-for="(weekday, date) in week" :class="{ 'bg-blue-light' : isToday(date) }">

                        <div v-for="order in orders[date]" class="bg-grey-light">
                            <div class="margin-5">
                                <div class="row">
                                    <div class="col-md-8">
                                        <strong class="pointer" @click="showOrder(order)" :title="order.title">{{trans('admin.Auftrag')}}</strong>
                                    </div>
                                    <div class="col-md-4 text-right">
                                        <i v-if="order.status == 'active'" class="fa fa-circle text-success" :title="trans('admin.Auftrag bestätigt')"></i>
                                        <i v-if="order.status == 'canceled'" class="fa fa-circle text-danger" :title="trans('admin.Order requested')"></i>
                                        <i v-if="order.status == 'requested'" class="fa fa-circle text-yellow" :title="trans('admin.Auftrag angefragt')"></i>
                                    </div>
                                </div>
                                <i class="fa fa-map-marker"></i> {{ order.work_location }} <br>
                                <i class="fa fa-clock-o"></i> {{ order.start_time }} {{trans('admin.Uhr')}} <br>
                                <div class="text-right">
                                    <strong>{{trans('admin.MA')}} {{ order.staff_required }}</strong>
                                </div>
                            </div>
                        </div>

                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>

<script>
    import Calendar from '../../../mixins/Calendar'

    export default {
        data() {
            return {
                start: moment().format(),
                week: [],
                orders: []
            }
        },
        mixins: [Calendar],

        methods: {
            getOrders() {
                let data = {
                    start: this.start
                };

                axios.post('/api/c/orders/by/week', data).then((response) => {
                    this.orders = response.data.orders
                    this.week = response.data.week
                });
            },

            showOrder(order) {
                modal('Show Order Modal', trans('admin.Auftrag anzeigen'), {'order': order});
            }

        }
    }
</script>

<style>
    table#order-calendar {
        height: 380px;
    }

    table#order-calendar thead {
        width: calc(100% - 0.9em);
    }

    table#order-calendar tbody {
        display: block;
        overflow-y: scroll;
        overflow-x: hidden;
    }

    table#order-calendar tbody tr {
        width: 100%;
    }

    table#order-calendar thead, table#order-calendar tbody tr {
        display: table;
        table-layout: fixed;
    }
</style>