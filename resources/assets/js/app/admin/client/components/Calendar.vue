<template>
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="row">
                <div class="col-md-6">
                    <div class="panel-title">{{trans('admin.Kalender')}}</div>
                </div>
                <div class="col-md-6 h5">
                    <ul class="pager list-unstyled pull-right">
                        <li>
                            <i @click="sub('months')" class="fa fa-angle-left fa-lg pointer margin-r-5 text-primary"></i>
                        </li>
                        <li>
                            {{trans('admin.'+ moment(start).locale('de').format('MMMM') )}} {{ moment(start).locale('de').format('YYYY') }}
                        </li>
                        <li>
                            <i @click="add('months')" class="fa fa-angle-right fa-lg  pointer margin-l-5 text-primary"></i>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="panel-body">
            <table v-for="(week, startOfWeek) in weeks" class="table" id="order-calendar" style="table-layout: fixed;margin:0;">
                <tbody>
                <tr class="bg-black-light">
                    <td style="width:40px;"></td>
                    <td v-for="(weekday, date) in week" class="padding-5">
                        {{trans('admin.'+ weekday)}}
                        <a href="#" @click.prevent="newOrder(date)" class="pull-right">
                            <i class="fa fa-plus"></i>
                        </a>
                    </td>
                </tr>
                <tr>
                    <td height="90px" style="width:40px;vertical-align: middle;">
                        {{trans('admin.KW')}} <br>{{ moment(startOfWeek).isoWeek() }}
                    </td>
                    <td v-for="(weekday, date) in week" :class="{ 'bg-blue-light' : isToday(date) }">
                        <div class="text-muted small pull-right">{{ moment(date).format('Do') }}</div>
                        <br>

                        <div v-for="order in orders[date]" class="bg-grey-light" :class="getOrderStatus(order)">
                            <div class="margin-5">
                                <div>
                                    <strong class="pointer" @click="openOrder(order)" :title="order.title">{{trans('admin.Auftrag')}}</strong>
                                </div>
                                <i class="fa fa-clock-o"></i> {{ order.start_time }}
                                <div class="pointer text-right" @click="assignEmployees(order)">
                                    <strong>{{ order.staff_planned + '/' + order.staff_required }}</strong>
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
                weeks: [],
                start: moment().format()
            }
        },
        props: ['client'],
        mixins: [Calendar],

        methods: {
            newOrder(date) {
                let data = {
                    'startDate': moment(date).format('L'),
                    'clients': [this.client],
                    'clientId': this.client.id
                };

                modal('New Order Modal', trans('admin.Neuer Auftrag'), data);
            },

            getOrders() {
                let data = {
                    start: this.start
                };

                axios.post('/api/client/' + this.client.id + '/calendar/dates', data).then((response) => {
                    this.orders = response.data.orders;
                    this.weeks = response.data.weeks;
                });
            },

            openOrder(order) {
                modal('Show Order Modal', trans('admin.Auftrag anzeigen'), {'order': order});
            },

            assignEmployees(order) {
                modal('Assign Employees Modal', trans('admin.Mitarbeiter einplanen'), {'order': order}, '100%');
            },

            getOrderStatus(order){
                if (order.status == 'canceled') {
                    return 'order-canceled';
                }

                if (order.staff_planned >= order.staff_required) {
                    return 'order-filled';
                }

                return 'order-unfilled';
            }

        },
        created() {
            this.getOrders();

            events.$on(['order.created', 'order.updated', 'personal.updated'], this.getOrders);
        }
    }
</script>