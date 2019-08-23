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
                        {{ trans('admin.'+ weekday) +', ' + moment(date).format('l') }}
                    </th>
                </tr>
                </thead>
                <tbody>
                <tr height="300px">
                    <td v-for="(weekday, date) in week" :class="{ 'bg-blue-light' : isToday(date) }">

                        <div v-for="order in orders[date]" class="bg-grey-light margin-t-10" :class="getOrderStatus(order)">
                            <div class="margin-5 pointer" @click="openOrder(order)">
                                <i v-if="order.start != order.end" class="fa fa-link"></i>
                                {{ shorten(order.client.short_name, 12) }}
                                <div>
                                    <i class="fa fa-clock-o"></i> {{ order.start_time }}
                                    <strong class="pull-right">{{ order.staff_planned + '/' + order.staff_required }}</strong>
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
                orders: [],

            }
        },
        mixins: [Calendar],

        methods: {
            getOrders() {
                let data = {
                    start: this.start
                };

                axios.post('/api/orders/by/week', data).then((response) => {
                    this.orders = response.data.orders
                    this.week = response.data.week
                });
            },

            openOrder(order) {
                let data = {
                    'order': order,
                    'type' : 'show'
                };

                modal('Show Order Modal', trans('admin.Auftrag anzeigen'), data);
            }

        }
    }
</script>

<style>
    table#order-calendar {
        height: 380px;
        display: flex;
        flex-flow: column;
        width: 100%;
    }

    table#order-calendar thead {
        flex: 0 0 auto;
        width: calc(100% - 0.9em);
    }

    table#order-calendar tbody {
        flex: 1 1 auto;
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